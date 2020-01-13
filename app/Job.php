<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    use SoftDeletes;

    public const jobActiveId = 1;
    public const jobAwardedId = 2;
    public const jobCompletedId = 3;
    public const jobCanceledId = 4;

    public const jobActive = "Active";
    public const jobAwarded = "Awarded";
    public const jobCompleted = "Completed";
    public const jobCanceled = "Canceled";

    protected $table = "job";
    protected $fillable = ['title' , 'budget' , 'description' , 'user_id' , 'skills' , 'job_id'];
    protected $appends = array('job_is_awarded' , 'allow_bid');

    public function getJobIsAwardedAttribute(){
     $check = Bids::select('is_awarded')->where('job_id' , $this->id)->where('is_awarded' , 1)->first();
     if($check == null){ $val = 0; } else { $val = 1; }
     return $val;
    }
    public function getAllowBidAttribute(){
        $check = false;
        if(Job::where('id' , $this->id)->where('status' , self::jobActiveId)->first() != null){
            $check = Bids::select('id')->where('job_id' , $this->id)->where('user_id' , Auth::user()->id)->first();
        }
        if($check == null){ $val = true; } else { $val = false; }
        return $val;
    }

    public function jobBids(){
       return $this->hasMany('App\Bids', 'job_id' , 'id');
    }

    public function scopeTotalBids(){
        if($this->jobBids->count() != 0) {
            return $this->jobBids->count();
        }
        return 0;
    }

    public function scopeAvgBid(){
        if($this->jobBids->count() != 0) {
            return $this->jobBids->avg('bid_amount');
        }
        return 0;
    }

    public function scopeMinBid(){
        if($this->jobBids->count() != 0){
            return $this->jobBids->min('bid_amount');
        }
        return 0;
    }

    public function scopeMaxBid(){
        if($this->jobBids->count() != 0) {
            return $this->jobBids->max('bid_amount');
        }
        return 0;
    }


}
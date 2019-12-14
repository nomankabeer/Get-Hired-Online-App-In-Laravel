<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Job extends Model
{
    use SoftDeletes;
    protected $table = "job";
    protected $fillable = ['title' , 'budget' , 'description' , 'user_id' , 'skills'];
    protected $appends = array('job_is_awarded');
    public function getJobIsAwardedAttribute(){
     $check = Bids::select('is_awarded')->where('job_id' , $this->id)->where('is_awarded' , 1)->first();
     if($check == null){ $val = 0; } else { $val = 1; }
     return $val;
    }
    public function jobBids(){
        return $this->hasMany('App\Bids', 'job_id' , 'id');
    }
}

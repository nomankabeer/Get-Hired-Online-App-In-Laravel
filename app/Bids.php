<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bids extends Model
{
    use SoftDeletes;
    protected $table = "freelancer_bids";
    protected $fillable = ['user_id' , 'job_id' , 'bid_amount' , 'proposal' , 'is_awarded'];

    public function userData(){
        return $this->hasOne('App\User' , 'id' , 'user_id');
    }

    public function userDetail(){
        return $this->hasOne('App\UserDetail' , 'user_id' , 'user_id');
    }
}

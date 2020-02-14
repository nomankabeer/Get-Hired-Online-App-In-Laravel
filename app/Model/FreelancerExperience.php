<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class FreelancerExperience extends Model
{
    protected $table = "freelancer_experience";
    protected $fillable = [ 'user_id' , 'title' , 'description' , 'start_date' , 'end_date'];
    public function userDetail(){
        return $this->belongsTo(FreelancerDetail::class , 'user_id' , 'user_id');
    }
}

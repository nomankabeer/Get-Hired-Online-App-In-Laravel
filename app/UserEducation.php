<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class UserEducation extends Model
{
    protected $table = "freelancer_education";
    protected $fillable = [ 'user_id' , 'degree_title' , 'description' , 'start_date' , 'end_date'];
    public function userDetail(){
        return $this->belongsTo(UserDetail::class , 'user_id' , 'user_id');
    }
}

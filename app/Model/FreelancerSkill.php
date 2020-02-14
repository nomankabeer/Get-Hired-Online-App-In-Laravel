<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class FreelancerSkill extends Model
{
    protected $table = "user_skill";
    protected $fillable = ['skill_id' , 'user_id'];
}

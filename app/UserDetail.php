<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class UserDetail extends Model
{
    protected $table = "freelancer_detail";
    /*protected $appends = array('user_skills');
    public function getUserSkillsAttribute(){
        $skill_ids = explode(',' , $this->skills);
        return Skill::whereIn('id' , $skill_ids)->pluck('name');
    }*/
    public function userName(){
        return $this->belongsTo(User::class,  'user_id' , 'id');
    }
    public function skills(){
        return $this->hasManyThrough(Skill::class, UserSkill::class , 'user_id' , 'id' ,'user_id' );
    }
    public function userEducation(){
        return $this->hasMany(UserEducation::class , 'user_id' , 'user_id');
    }
    public function userExperience(){
        return $this->hasMany(UserExperience::class , 'user_id' , 'user_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class FreelancerDetail extends Model
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
        return $this->hasManyThrough(Skill::class, FreelancerSkill::class , 'user_id' , 'id' ,'user_id' , 'skill_id' );
    }
    public function userEducation(){
        return $this->hasMany(FreelancerEducation::class , 'user_id' , 'user_id');
    }
    public function userExperience(){
        return $this->hasMany(FreelancerExperience::class , 'user_id' , 'user_id');
    }
}

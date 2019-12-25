<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\FreelancerSkill;
use App\Services\BaseService;
use App\FreelancerExperience;
class FreelancerDeleteSkill extends BaseService
{
    public function deleteSkill($id){
        $msg = array();
        $status = false;
        $freelancer_skill = FreelancerSkill::where('skill_id' ,$id)->where('user_id' , $this->getUserId());
        if ($freelancer_skill != null){
            if ($freelancer_skill->delete()) {
                $status = true;
                $msg[] = 'Skill Deleted';
            } else {
                $msg[] = 'Something went wrong';
            }
        }
        else{
            $msg[] = 'Something went wrong. Please Contact to Customer Support';
        }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }
}
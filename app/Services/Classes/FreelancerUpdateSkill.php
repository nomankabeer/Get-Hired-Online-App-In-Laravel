<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Services\BaseService;
use App\FreelancerSkill;
use Illuminate\Support\Facades\Validator;
class FreelancerUpdateSkill extends BaseService
{
    public function updateSkill($data){
        $msg = array();
        $status = false;
            $this->validateData($data)->validate();
            $data = $this->processDataToStore($data);
            if(FreelancerSkill::where('user_id' , $this->getUserId())->where('skill_id' , $data['skill_id'])->first() === null){
                if (FreelancerSkill::where('user_id' , $this->getUserId())->where('skill_id' , $data['id'])->update(['skill_id' => $data['skill_id']])){
                    $status = true;
                    $msg[] = 'Skill Updated';
                } else {
                    $msg[] = 'Something went wrong';
                }
            }
            else{
            $msg[] = 'You already have selected this skill';
            }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }

    private function validateData($data){
        return Validator::make($data, [
            'skill_id' => ['required', 'integer']
        ]);
    }
}
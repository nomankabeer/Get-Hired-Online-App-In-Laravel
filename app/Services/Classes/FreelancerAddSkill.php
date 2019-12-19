<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Services\BaseService;
use App\User;
use App\FreelancerSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class FreelancerAddSkill extends BaseService
{
    public function addSkill($data){
        $msg = array();
        $status = false;
        if (Auth::user()->userDetail->skills->count() <= 10) {
            $this->validateData($data)->validate();
            $data = $this->processDataToStore($data);
            if(FreelancerSkill::where('user_id' , $this->getUserId())->where('skill_id' , $data['skill_id'])->first() === null){
                if (FreelancerSkill::create($data)) {
                    $status = true;
                    $msg[] = 'Skill Added';
                } else {
                    $msg[] = 'Something went wrong';
                }
            }
            else{
            $msg[] = 'You already have selected this skill';
            }
        }
        else{
            $msg[] = 'You reached your limit to add Skill to your profile';
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
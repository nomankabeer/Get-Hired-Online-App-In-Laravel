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
use App\FreelancerExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class FreelancerAddExperience extends BaseService
{
    public function addExperience($data){
        $msg = array();
        $status = false;
        if (Auth::user()->userDetail->userExperience->count() <= 4) {
            $this->validateData($data)->validate();
            $data = $this->processDataToStore($data);
            if (FreelancerExperience::create($data)) {
                $status = true;
                $msg[] = 'Experience Added';
            } else {
                $msg[] = 'Something went wrong';
            }
        }
        else{
            $msg[] = 'You reached your limit to add Experience to your profile';
        }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }

    private function validateData($data){
        return Validator::make($data, [
            'title' => ['required', 'string', 'min:3' , 'max:40'],
            'description' => ['required', 'string', 'min:3' , 'max:500'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
    }
}
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
class FreelancerUpdateExperience extends BaseService
{
    public function updateExperience($data){
        $msg = array();
        $status = false;
        $user_Experience = FreelancerExperience::find($data['id']);
        if ($user_Experience != null && $user_Experience->user_id === $this->getUserId()){
            $this->validateData($data)->validate();
            $data = $this->processDataToStore($data);
            if ($user_Experience->update($data)) {
                $status = true;
                $msg[] = 'Experience Updated';
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

    private function validateData($data){
        return Validator::make($data, [
            'title' => ['required', 'string', 'min:3' , 'max:40'],
            'description' => ['required', 'string', 'min:3' , 'max:500'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
    }
}
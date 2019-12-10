<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\ServiceProviders\Classes;
use App\Repositories\ServiceProviders\BaseServiceProvider;
use App\User;
use App\UserEducation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class FreelancerUpdateEducation extends BaseServiceProvider
{
    public function updateEducation($data){
        $msg = array();
        $status = false;
        $user_education = UserEducation::find($data['id']);
        if ($user_education != null && $user_education->user_id === $this->getUserId()){
            $this->validateData($data)->validate();
            $data = $this->processDataToStore($data);
            if ($user_education->update($data)) {
                $status = true;
                $msg[] = 'Education Updated';
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
            'degree_title' => ['required', 'string', 'min:3' , 'max:40'],
            'description' => ['required', 'string', 'min:3' , 'max:500'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
    }
}
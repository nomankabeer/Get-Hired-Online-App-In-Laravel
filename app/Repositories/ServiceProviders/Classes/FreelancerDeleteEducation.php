<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\ServiceProviders\Classes;
use App\Repositories\ServiceProviders\BaseServiceProvider;
use App\UserEducation;
class FreelancerDeleteEducation extends BaseServiceProvider
{
    public function deleteEducation($id){
        $msg = array();
        $status = false;
        $user_education = UserEducation::find($id);
        if ($user_education != null && $user_education->user_id === $this->getUserId()){
            if ($user_education->delete()) {
                $status = true;
                $msg[] = 'Education Deleted';
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
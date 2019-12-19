<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Services\BaseService;
use App\FreelancerExperience;
class FreelancerDeleteExperience extends BaseService
{
    public function deleteExperience($id){
        $msg = array();
        $status = false;
        $user_Experience = FreelancerExperience::find($id);
        if ($user_Experience != null && $user_Experience->user_id === $this->getUserId()){
            if ($user_Experience->delete()) {
                $status = true;
                $msg[] = 'Experience Deleted';
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
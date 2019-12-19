<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\FreelancerDetail;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;
class FreelancerUpdateAboutMe extends BaseService
{
    public function updateAboutMe($data){
        $this->validate($data->all())->validate();
        $msg = array();
        $status = false;
        $user_about_me = FreelancerDetail::where('user_id' , $this->getUserId());
            if ($user_about_me->update(['about_me' => $data->about])) {
                $status = true;
                $msg[] = 'About me updated';
            } else {
                $msg[] = 'Something went wrong';
            }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }

    private function validate($data){
        return Validator::make($data, [
            'about' => ['required', 'string'],
        ]);
    }
}
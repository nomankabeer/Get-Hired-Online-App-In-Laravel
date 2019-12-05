<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Traits;
use App\Bids;
use App\Order;
use App\Skill;
use App\User;
trait FreelancerProfileTrait
{
    public function getFreelancerProfileData($name){
        $data = null;
        $freelancer = User::select('id' , 'name' , 'email' , 'avatar' , 'created_at')->where('name' , $name)->where('role_id' , User::freelancerRoleId);
        if($freelancer->count()){
            $active_account = $freelancer->where('account_status' , User::accountActive);
            if($active_account->count()){
                $status = true;
                $msg = ["Freelancer profile found"];
                $data['user_detail'] = $active_account->with(['userDetail' , 'userDetail.skills:skill.id,skill.name' , 'userDetail.userEducation' , 'userDetail.userExperience'])->first();
                $data['order_detail'] = $this->getUserOrderDetail($data['user_detail']->id);
                $data['skills'] = Skill::get()->all();
            }
            else{
                $status = false;
                $msg = ["Freelancer profile is restricted"];
            }
        }
        else{
            $status = false;
            $msg = ["Freelancer not exist with this user name"];
        }
        $profile_data = array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        );
        return $profile_data;
    }
    private function getUserOrderDetail($id){
        return Order::whereIn('bid_id' , Bids::where('user_id' , $id)->where('is_awarded' , 1)->pluck('id'))->with('jobDetail')->get();
    }
}
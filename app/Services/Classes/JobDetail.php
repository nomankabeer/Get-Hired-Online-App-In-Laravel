<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Bids;
use App\Job;
use App\Services\BaseService;
class JobDetail extends BaseService
{
    public function jobDetail($id , $status = null , $freelancer_id = null){
        $data = null;
        $freelancer_bid = null;
        $job = Job::where('id' , $id);
        if($status != null){
            $job = $job->where('status' , $status);
        }

        if($freelancer_id != null){
            $freelancer_bid = Bids::where('job_id' , $id)->where('user_id' , $freelancer_id)->first();
        }

        $job = $job->first();

        if($job != null){
            $data['job'] = $job;
            $data['freelancer_bid'] = $freelancer_bid;
            $status = true;
            $msg = ['Job Found'];
        }
        else{
            $status = false;
            $msg = ['Job Not Found'];
        }
        $data = array(
            'data' => $data,
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }
}
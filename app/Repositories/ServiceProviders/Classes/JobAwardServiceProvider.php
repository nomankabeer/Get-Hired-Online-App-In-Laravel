<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\ServiceProviders\Classes;
use App\Bids;
use App\Job;
use App\Repositories\ServiceProviders\BaseServiceProvider;

class JobAwardServiceProvider extends BaseServiceProvider
{
    public function awardJob($job_id , $bid_id){
        $job_exist = $this->jobExist($job_id);
        if($job_exist === true){
//          if job exist.
            $alreadyAwarded = $this->alreadyAwarded($job_id);
//          check if job is already awarded
            if($alreadyAwarded === false){
                $bidExist = $this->bidExist($bid_id);
                if($bidExist === true){
                    $award_job = $this->awardJobToUser($job_id , $bid_id);
                    if($award_job){
//                     job awarded
                        $status = true;
                        $msg = ['Success' , 'job is Awarded'];
                    }
                    else{
                        $status = false;
                        $msg = ['error' , 'Something went wrong. Please contact to customer support'];
                    }
                }
                else{
                    $status = false;
                    $msg = ['error' , 'User Bid Not Found'];
                }
            }
            else{
//              job already awarded
                $status = false;
                $msg = ['Job Already Awarded' , 'If you have any issue please contact customer support'];
            }
        }
        else{
//          job does not exist
            $status = false;
            $msg = ['Job Not Found' , 'If you have any issue please contact customer support'];
        }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }
    private function jobExist($job_id){
//      check if this job is exist
        $check = Job::select('id')->where('id' , $job_id)->where('user_id' , $this->getUserId())->first();
        if($check == null){ $val = false; } else { $val = true; }
        return $val;
    }
    private function alreadyAwarded($job_id){
//      Check if user id already awarded this job
        $check = Bids::select('is_awarded')->where('job_id' , $job_id)->where('is_awarded' , 1)->first();
        if($check == null){ $val = false; } else { $val = true; }
        return $val;
    }
    private function bidExist($bid_id){
        $bidExist = Bids::where('id' , $bid_id)->first();
        if($bidExist != null){
            return true;
        }
        else{
            return false;
        }
    }
    private function awardJobToUser($job_id , $bid_id){
        if(Bids::where('job_id' , $job_id)->where('id' , $bid_id)->update(['is_awarded' => 1])){
            return true;
        }
        else{
            return false;
        }
    }
}
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
use App\Order;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;

class FreelancerJobBid extends BaseService
{
    public function jobBid($data){
        $this->validateData($data->all())->validate();
        $status = false;
        $msg = null;
        $job = Job::where('job_id' , $data->job_id);
        if($job->count() != 0){
            $job = $job->where('status' , Job::jobActiveId)->first();
            if($job != null){
                $bid = array(
                    'job_id' => $job->id,
                    'bid_amount' => $data->bid_amount,
                    'proposal' => $data->proposal,
                    'user_id' => $this->getUserId(),
                );
                if(Bids::create($bid)){
                    $status = true;
                    $msg = "Your proposal is successfully submitted";
                }
                else{
                    $msg = "Something went wrong";
                }
            }
            else{
                $msg = "This job is not available to bid";
            }
        }
        else{
            $msg = "Job Not Found";
        }
        $data = array(
            'status' => $status,
            'msg' => [$msg],
            'data' => $job,
        );
        return $data;
    }

    private function validateData($data){
        return Validator::make($data, [
            'bid_amount' => ['required', 'integer'],
            'job_id' => ['required', 'string'],
            'proposal' => ['required', 'string'],
        ]);
    }
}
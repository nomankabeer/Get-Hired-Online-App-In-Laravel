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

class FreelancerJobCompletedDetail extends BaseService
{
    public function freelancerJobCompletedDetail($id){
        $status = false;
        $msg = "Job Not Found";
        $job = Job::where('id' , $id);
        if($job->count() === 1){
            $job = $job->where('status' , Job::jobCompletedId)->first();
            if($job != null){
                $bid = Bids::where('user_id' , $this->getUserId())->where('job_id' , $job->id)->first();
                if($bid != null){
                    $order = Order::with('orderDeliveries')->where('bid_id' , $bid->id)->where('job_id' , $job->id)->where('status' , Order::orderCompletedId)->first();
                    dd($job->toArray() , $bid->toArray() , $order->toArray());
                }
            }
        }
        $data = array(
            'status' => $status,
            'msg' => [$msg],
            'data' => $job,
        );
        return $data;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 07-Jan-2020
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Order;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;

class FreelancerJobCompletedReview extends BaseService
{
    public function freelancerJobReview($data){
        $this->validateData($data->all())->validate();
        $returnData = null;
        $status = false;
        $msg = "Something went wrong";
        $order = Order::with('bidDetail')->where('order_id' , $data->order_id)->where('status' , Order::orderCompletedId);
        if($order->count() === 1){
            $order = $order->first();
            if($order != null && $order->bidDetail->user_id === $this->getUserId() && $order->bidDetail->is_awarded == 1){
                $freelancer_review = array(
                    'freelancer_review' => $data->freelancer_review,
                    'freelancer_rating' => $data->freelancer_rating
                );
                if($order->update($freelancer_review) === true){
                  $status = true;
                  $msg = "Order Rating Successfully Update";
                }
            }
        }
        $data = array(
            'status' => $status,
            'msg' => [$msg],
            'order' => $order,
        );
        return $data;
    }

    private function validateData($data){
        return Validator::make($data, [
            'freelancer_review' => ['required', 'string', 'min:5' , 'max:50'],
            'order_id' => ['required', 'string'],
            'freelancer_rating' => ['required', 'integer', 'min:1' , 'max:5'],
        ]);
    }
}
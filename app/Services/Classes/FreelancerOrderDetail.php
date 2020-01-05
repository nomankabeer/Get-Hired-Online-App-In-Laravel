<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Order;
use App\Services\BaseService;

class FreelancerOrderDetail extends BaseService
{
    public function OrderDetail($order_id){

        $order = null;
        $check = $this->currentOrder($order_id);
        if($check === true){
            $order = Order::where('id' , $order_id)->with("orderDeliveries" , 'jobDetail' , 'bidDetail')->first();
            $status = true;
            $msg = ['Record Found'];
        }
        elseif ($check === false){
            $status = false;
            $msg = ['Order Not Found' , 'if you have any issue please contact to customer support'];
        }
        $data = array(
            'status' => $status,
            'msg' => $msg,
            'data' => $order
        );
        return $data;
    }

    private function currentOrder($order_id){
        $order = Order::where('id' , $order_id)->first();
        if($order != null &&  $order->bidDetail->user_id === $this->getUserId()){
            return true;
        }
        else{
            return false;
        }
    }
}
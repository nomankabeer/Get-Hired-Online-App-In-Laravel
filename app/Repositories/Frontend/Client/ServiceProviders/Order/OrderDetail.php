<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Client\ServiceProviders\Order;
use App\Order;
use App\Repositories\BaseRepository;
class OrderDetail extends BaseRepository
{
    public function clientOrderDetail($order_id){
        $order = null;
        $check = $this->currentClientOrder($order_id);
        if($check === true){
            $order = Order::where('id' , $order_id)->with("orderDeliveries" , 'jobDetail' , 'bidDetail.userDetail')->first();
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
    private function currentClientOrder($order_id){
        $order = Order::where('id' , $order_id)->first();
        if($order != null && $order->jobDetail->user_id === $this->getUserId()){
            return true;
        }
        else{
            return false;
        }
    }
}
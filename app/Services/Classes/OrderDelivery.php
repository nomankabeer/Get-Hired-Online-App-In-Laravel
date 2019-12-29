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
use Illuminate\Support\Facades\Validator;
use App\OrderDelivery as OrderDeliveryModel;
class OrderDelivery extends BaseService
{
    public function orderDelivery($data){
        $order = null;
        $status = false;
        $data = array(
            'order_id'=> $data->order_id,
            'content' => $data->content,
        );
        $this->validateData($data)->validate();
        $authenticatedOrder = $this->authenticateOrder($data);
        if($authenticatedOrder['status'] === true){
            $order = $authenticatedOrder['data'];
            if($order->status === Order::orderCompletedId){
                $msg = ['Order is completed'];
            }
            elseif($order->status === Order::orderCanceledId){
                $msg = ['Order is cancelled'];
            }
            else{
                $isStored = $this->storeDelivery($data , $order);
                $msg = ['Order delivered successfully'];
            }
        }
        elseif ($authenticatedOrder['status'] === false){
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

    private function storeDelivery($data , $order){
//        OrderDeliveryModel::
    }

    private function authenticateOrder($data){
        $order = Order::with('bidDetail')->where('order_id' , $data['order_id'])->first();
        if($order != null && $order->bidDetail->user_id === $this->getUserId()){
            return ['status' => true , 'data' => $order];
        }
        else{
            return ['status' => false , 'data' => null];
        }
    }

    private function validateData($data){
        return Validator::make($data, [
            'order_id' => ['required', 'string'] ,
            'content' => ['required', 'string']
        ]);
    }

}
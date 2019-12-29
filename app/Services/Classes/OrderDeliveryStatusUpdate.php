<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Service\Classes;
use App\Order;
use App\OrderDelivery;
use App\Services\BaseService;

class OrderDeliveryStatusUpdate extends BaseService

{
    public function updateDeliveryStatus($delivery_id , $status_id){
        $order_id = null;
        $check_order_id = $this->checkStatusid($status_id);
        if($check_order_id === true){
            $order_id = $this->deliveryExist($delivery_id);
            if($order_id > 0){
                $order_exist = $this->currentUserOrderExist($order_id);
                if($order_exist == true){
                    $isOrderStatusAccepted = $this->isOrderStatusAccepted($order_id);
                    if($isOrderStatusAccepted == false){
                        $isOrderStatusPending = $this->isDeliveryStatusPending($delivery_id);
                        if($isOrderStatusPending === true){
                            $updateStatus = $this->updateStatus($delivery_id , $status_id);
                            if($updateStatus === true){
                                $this->updateOrderStatus($order_id , $status_id);
                                if($status_id == OrderDelivery::orderDeliveryStatusAcceptedId){
                                    $this->makeOtherDeliveriesRejected($order_id , $delivery_id);
                                }
                                $status = true;
                                $msg = ['Order Status Updated Successfully'];
                            }
                            else{
                                $status = false;
                                $msg = ['Something went wrong. Please contact to customer support'];
                            }
                        }
                        else{
                            $status = false;
                            $msg = ['You Already Have Rejected This Delivery' , 'Please Contact to customer support if you have any issue'];
                        }
                    }
                    elseif($isOrderStatusAccepted == true){
                        $status = false;
                        $msg = ['You Already Accepted Delivery For This Order.' , 'Please Contact to customer support if you have any issue'];
                    }
                }
                else{
                    $status = false;
                    $msg = ['No Order Found. Please Contact to customer support'];
                }
            }
            elseif($order_id == false){
                $status = false;
                $msg = ['No Order Delivery Found. Please Contact to customer support'];
            }
        }
        else{
            $status = false;
            $msg = [ 'Update Order status is not correct' , 'Please Contact to customer support'];
        }
        $data = array(
            'status' => $status,
            'msg' => $msg,
            'order_id' => $order_id,
        );
        return $data;
    }
    private function deliveryExist($delivery_id){
        $order_delivery = OrderDelivery::select('order_id')->where('id' , $delivery_id)->first();
        if($order_delivery != null){
            return $order_delivery->order_id;
        }
        else{
            return false;
        }
    }
    private function currentUserOrderExist($order_id){
        $order = Order::where('id' , $order_id)->first();
        if($order != null && $order->jobDetail->user_id === $this->getUserId()){
            return true;
        }
        else{
            return false;
        }
    }
    private function isOrderStatusAccepted($order_id){
        $order_delivery = OrderDelivery::where('order_id' , $order_id)->where('status' , OrderDelivery::orderDeliveryStatusAcceptedId)->count();
        if($order_delivery > 0){
            return true;
        }
        else{
            return false;
        }
    }
    private function isDeliveryStatusPending($delivery_id){
        if(OrderDelivery::where('id' , $delivery_id)->first()->status === OrderDelivery::orderDeliveryStatusPendingId){
            return true;
        }
        else{
            return false;
        }
    }
    private function updateStatus($delivery_id , $status_id){
        if(OrderDelivery::where('id' , $delivery_id)->update(['status' => $status_id])){
            return true;
        }
        else{
            return false;
        }
    }
    private function checkStatusid($status_id){
        if($status_id == OrderDelivery::orderDeliveryStatusAcceptedId || $status_id == OrderDelivery::orderDeliveryStatusRejectedId){
            return true;
        }
        else{
            return false;
        }
    }
    private function makeOtherDeliveriesRejected($order_id , $delivery_id){
        if(OrderDelivery::where('order_id' , $order_id)->where('id' , '<>' , $delivery_id)->update(['status' => OrderDelivery::orderDeliveryStatusRejectedId])){
            return true;
        }
        else{
            return false;
        }
    }
    private function updateOrderStatus($order_id , $status_id){
        if(Order::where('id' , $order_id)->update(['status' => $status_id])){
            return true;
        }
        else{
            return false;
        }
    }
}
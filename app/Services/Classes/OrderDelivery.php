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
use App\Repositories\Traits\UploadFileTrait;
class OrderDelivery extends BaseService
{
    use UploadFileTrait;
    public function orderDelivery($deliverData){
        $order = null;
        $status = false;
        $this->validateData($deliverData->all())->validate();
        $data = array(
            'order_id'=> $deliverData->order_id,
            'content' => $deliverData->content,
        );
        $authenticatedOrder = $this->authenticateOrder($data);
        if($authenticatedOrder['status'] === true){
            $order = $authenticatedOrder['data'];
            if($order->status === Order::orderCompletedId && OrderDeliveryModel::where('order_id' , $order->id)->where('status' , OrderDeliveryModel::orderDeliveryStatusAcceptedId)->count() == 1){
                $msg = ['Order is completed'];
            }
            elseif($order->status === Order::orderCanceledId){
                $msg = ['Order is cancelled'];
            }
            else{
                $isStored = $this->storeDelivery($deliverData , $order);
                if($isStored === true){
                    $order->status = Order::orderDeliveredId;
                    $order->update();
                    $status = true;
                    $msg = ['Order delivered successfully'];
                }
                else{
                    $msg = ['Something went wrong'];
                }
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

    private function storeDelivery($deliverData , $order){
        $file = null;
        if($deliverData->hasFile('file')){
            $file = $this->uploadOrderFiles($deliverData->file , $order->order_id);
        }
        $orderDelivery = array(
            'order_id' => $order->id,
            'content' => $deliverData->content,
            'file' => $file,
            'status' => OrderDeliveryModel::orderDeliveryStatusPendingId,
        );
        if(OrderDeliveryModel::create($orderDelivery)){
            return true;
        }
        else{
            return false;
        }
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
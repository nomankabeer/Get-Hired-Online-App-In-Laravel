<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\ServiceProviders\Classes;
use App\Order;
use App\Repositories\ServiceProviders\BaseServiceProvider;
class OrderStoreServiceProvider extends BaseServiceProvider
{
    public function createOrderForUser($data){
        if(Order::create($data)){
            $status = true;
            $msg = ['Order Created' , 'Visit order detail page'];
        }
        else{
            $status = false;
            $msg = ['Something went wrong'];
        }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }
}
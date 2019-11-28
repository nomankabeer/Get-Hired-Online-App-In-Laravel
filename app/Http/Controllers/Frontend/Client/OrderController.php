<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Client\OrderRepository;
class OrderController extends Controller
{
    protected $orderRepository = null;
    public function __construct(OrderRepository $orderRepository){
    $this->orderRepository = $orderRepository;
    }

    public function index(){
        return view('frontend.client.order.order_list');
    }

    public function getOrderList(){
        return $this->orderRepository->userOrderListData();
    }

    public function orderDetail($id){
        return $this->orderRepository->getClientOrderDetail($id);
    }

    public function orderUpdateDeliveryStatus($delivery_id , $status_id){
        return $this->orderRepository->updateDeliveryStatus($delivery_id , $status_id);
    }
}

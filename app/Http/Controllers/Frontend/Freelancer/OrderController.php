<?php

namespace App\Http\Controllers\Frontend\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Order\OrderRepository;
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
}

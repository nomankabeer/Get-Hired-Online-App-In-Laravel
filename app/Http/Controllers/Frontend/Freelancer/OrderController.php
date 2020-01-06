<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Freelancer\OrderRepository;
class OrderController extends Controller
{
    protected $orderRepository = null;
    public function __construct(OrderRepository $orderRepository){
    $this->orderRepository = $orderRepository;
    }
    public function activeOrderListView(){
        return $this->orderRepository->activeOrderListView();
    }
    public function activeOrderList(){
        return $this->orderRepository->activeOrderList();
    }
    public function activeOrderDetail($id){
        return $this->orderRepository->activeOrderDetail($id);
    }
    public function orderDelivery(Request $request){
        return $this->orderRepository->orderDelivery($request);
    }
}

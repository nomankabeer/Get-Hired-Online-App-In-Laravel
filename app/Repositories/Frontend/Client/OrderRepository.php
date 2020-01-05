<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Client;
use App\Job;
use App\Order;
use App\Repositories\BaseRepository;
use App\Services\Classes\OrderDeliveryStatusUpdate;
use App\Services\Classes\OrderDetail;
use App\Services\Classes\OrderReview;
use App\Services\Classes\OrderStore;
use Yajra\DataTables\Facades\DataTables;
class OrderRepository extends BaseRepository
{
    protected $redirect = null;
    protected $orderDetailView = 'frontend.client.order.order_detail';
    protected $orderListRoute = 'client.orders.list';
    protected $orderDetailRoute = 'client.order.detail';
    protected $orderDetailURL = 'order/detail/';

    public function createOrder($job_id , $bid_id){
        $data = array(
            'bid_id' => $bid_id,
            'job_id' => $job_id,
            'order_id' => uniqid(),
        );
        $storeOrderService = new OrderStore();
        $data = $storeOrderService->createOrderForFreelancer($data);
        $this->redirect = $this->orderListRoute;
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function getClientOrderDetail($id){
        $orderDetail = new OrderDetail();
        $data = $orderDetail->OrderDetail($id);
        if($data['status'] === false){
            $this->redirect = $this->orderListRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        elseif($data['status'] === true){
            $this->redirect = $this->orderDetailView;
            return $this->redirectView($data['status'] , $data['msg'] , $data['data']);
        }
    }

    public function updateDeliveryStatus($delivery_id , $status_id){
        $orderDelivery = new OrderDeliveryStatusUpdate();
        $data = $orderDelivery->updateDeliveryStatus($delivery_id , $status_id);
        if($data['status'] === false){
            $this->redirect = $this->orderListRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        elseif($data['status'] === true){
            $this->redirect = $this->orderDetailURL.$data['order_id'];
            return $this->redirectURL($data['status'] , $data['msg'] );
        }
    }

    public function userOrderListData(){
        $job_ids = Job::where('user_id' , $this->getUserId())->pluck('id');
        return DataTables::of(Order::query()->with('jobDetail')->whereIn('job_id', $job_ids)->orderBy('id', 'desc'))
            ->editColumn('created_at', function (Order $order) {
                return $order->created_at->diffForHumans() ;
            })
            ->addColumn('action', function (Order $order) {
                return '
                <a href="' . route("client.order.detail", $order->id) . '" class="btn btn-success">View Details</a>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Order $order) {
                return $order->id;
            })
            ->make(true);
    }

    public function clientOrderReview($data){
        $review = new OrderReview();
        $data = $review->reviewOrder($data);
        if($data['status'] === false){
            $this->redirect = $this->orderListRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        elseif($data['status'] === true){
            $this->redirect = $this->orderDetailURL.$data['order_id'];
            return $this->redirectURL($data['status'] , $data['msg'] );
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Freelancer;
use App\Bids;
use App\Job;
use App\Order;
use App\Repositories\BaseRepository;
use App\Services\Classes\FreelancerJobCompletedReview;
use App\Services\Classes\FreelancerOrderDetail;
use App\Services\Classes\OrderDelivery;
use Yajra\DataTables\Facades\DataTables;
class OrderRepository extends BaseRepository
{
    protected $redirect = null;
    protected $orderDetail = null;
    protected $orderDelivery = null;
    protected $orderListView = 'frontend.freelancer.order.order_list';
    protected $activeJobListRoute = 'freelancer.active.order.list.view';
    protected $activeJobOrderView = 'frontend.freelancer.order.order_detail';
    protected $activeJobOrderDetail = 'active/order/detail/';
    protected $completedJobDetailUrl = 'completed/job/detail/';
    protected $completedJobListRoute = 'freelancer.completed.job.list.view';

    public function __construct(
        FreelancerOrderDetail $orderDetail,
        OrderDelivery $orderDelivery
    )
    {
        $this->orderDetail = $orderDetail;
        $this->orderDelivery = $orderDelivery;
    }

    public function activeOrderListView(){
        return view($this->orderListView);
    }

    public function activeOrderList(){
        $bid_ids = Bids::where('user_id' , $this->getUserId())->where('is_awarded' , 1)->pluck('id');
        return DataTables::of(Order::query()->with('jobDetail')->whereIn('bid_id' , $bid_ids)->whereNotIn('status', [Order::orderCanceledId , Order::orderCompletedId ])->orderBy('id', 'desc'))
            ->addColumn('action', function (Order $order) {
                return '
                <a href="' . route("freelancer.active.order.detail", $order->id) . '" class="btn btn-success">Details</a>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Order $order) {
                return $order->id;
            })
            ->make(true);
    }

    public function activeOrderDetail($id){
        $data = $this->orderDetail->OrderDetail($id);
        if($data['status'] === false){
            $this->redirect = $this->activeJobListRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        $this->redirect = $this->activeJobOrderView;
        return $this->redirectView($data['status'] , $data['msg'] , $data['data']);
    }

    public function orderDelivery($data){
        $data = $this->orderDelivery->orderDelivery($data);
        if($data['status'] === false){
            $this->redirect = $this->activeJobListRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        $this->redirect = $this->activeJobOrderDetail.$data['data']->id;
        return $this->redirectURL($data['status'] , $data['msg']);
    }

    public function freelancerOrderReview($data){
        $jobReview = new freelancerJobCompletedReview();
        $data = $jobReview->freelancerJobReview($data);
        if($data['status'] === false){
            $this->redirect = $this->completedJobListRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        $this->redirect = $this->completedJobDetailUrl.$data['order']->job_id;
        return $this->redirectURL($data['status'] , $data['msg']);

    }
}
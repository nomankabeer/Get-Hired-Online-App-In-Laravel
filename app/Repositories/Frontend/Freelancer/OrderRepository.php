<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Order;
use App\Job;
use App\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class OrderRepository extends BaseRepository
{
    protected $redirect = null;
    protected $orderDetailView = 'frontend.client.job_detail';

    public function createOrder(){

    }

   /* public function userOrderListData(){
        return "dsfasf";
        return Order::with('jobDetail')->where('user_id', $this->getUserId())->orderBy('id', 'desc');
        return DataTables::of(Order::with('jobDetail')->query()->where('user_id', $this->getUserId())->orderBy('id', 'desc'))
            ->addColumn('action', function (Order $order) {
                return '
                <a href="#" data-toggle="modal" data-target="#editModal" onclick="edit(' . $order->id . ')"  class="btn btn-primary">Edit</a>
                <a href="' . route("client.job.detail", $order->id) . '" class="btn btn-success">Details</a>
                <a href="' . route("client.job.delete", $order->id) . '" class="btn btn-danger">Delete</a>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Order $order) {
                return $order->id;
            })
            ->make(true);
    }*/
}
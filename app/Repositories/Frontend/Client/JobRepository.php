<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Client;
use App\Job;
use App\Repositories\BaseRepository;
use App\Repositories\ServiceProviders\Classes\JobAwardServiceProvider;
use App\Repositories\ServiceProviders\Classes\JobStoreServiceProvider;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class JobRepository extends BaseRepository
{
    protected $redirect = null;
    protected $jobListRoute = 'client.job.list';
    protected $jobDetailView = 'frontend.client.job.job_detail';
    protected $jobDetailURL = "job/detail/";

    public function awardUserBidForJob($job_id , $bid_id){
        //set redirect url
        $this->redirect = $this->jobDetailURL.$job_id;

        //Award Job
        $awardJobService = new JobAwardServiceProvider();
        $data = $awardJobService->awardJob($job_id , $bid_id );

        if($data['status'] === false){
        // return if job is already awarded
            return $this->redirectURL($data['status'] , $data['msg']);
        }

        elseif($data['status'] === true){
        //  Create Order for client and freelancer
            $orderRepository = new OrderRepository();
            $order_data = $orderRepository->createOrder($job_id , $bid_id );
            $data['msg'] = array_merge($data['msg'] , $order_data['msg'] );
            return $this->redirectURL($data['status'] , $data['msg']);
        }

    }

    public function storeJobData($data){
        $this->redirect = $this->jobListRoute;
        $awardJobService = new JobStoreServiceProvider();
        $data = $awardJobService->storeClientJob($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function getUserJobPosts(){
        return DataTables::of(Job::query()->where('user_id', $this->getUserId())->orderBy('id', 'desc'))
            ->addColumn('action', function (Job $job) {
                return '
                <a href="#" data-toggle="modal" data-target="#editModal" onclick="edit(' . $job->id . ')"  class="btn btn-primary">Edit</a>
                <a href="' . route("client.job.detail", $job->id) . '" class="btn btn-success">Details</a>
                <a href="' . route("client.job.delete", $job->id) . '" class="btn btn-danger">Delete</a>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Job $job) {
                return $job->id;
            })
            ->make(true);
    }

    public function getUSerJobDetail($id){
        $job = Job::where('id' , $id)->where('user_id' , $this->getUserId())
            ->with(['jobBids:bids.id,bids.job_id,bids.user_id,bids.proposal,bids.bid_amount,bids.is_awarded,bids.created_at' , 'jobBids.userDetail'])
            ->first();
        if($job === null){
            $this->redirect = $this->jobListRoute;
            $status = false;
            $msg = ['Job Not Found' , 'If you have any issue please contact customer support'];
            return $this->redirectRoute($status , $msg);
        }
        else{
            $this->redirect = $this->jobDetailView;
            $status = true;
            $msg = ['Success'];
            return $this->redirectView($status , $msg , $job);
        }

    }
}
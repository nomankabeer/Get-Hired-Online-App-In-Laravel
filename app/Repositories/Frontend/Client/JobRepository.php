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
use App\Services\Classes\JobAward;
use App\Services\Classes\JobStore;
use App\Services\Classes\OrderStore;
use Yajra\DataTables\Facades\DataTables;
class JobRepository extends BaseRepository
{
    protected $redirect = null;
    protected $jobListRoute = 'client.job.list';
    protected $jobDetailView = 'frontend.client.job.job_detail';
    protected $jobDetailURL = "job/detail/";
    protected $orderListRoute = 'client.orders.list';

    public function awardUserBidForJob($job_id , $bid_id){
        //set redirect url
        $this->redirect = $this->jobDetailURL.$job_id;

        //Award Job
        $awardJobService = new JobAward();
        $data = $awardJobService->awardJob($job_id , $bid_id );

        if($data['status'] === false){
        // return if job is already awarded
            return $this->redirectURL($data['status'] , $data['msg']);
        }

        elseif($data['status'] === true){
        //  Create Order for client and freelancer
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
    }

    public function storeJobData($data){
        $this->redirect = $this->jobListRoute;
        $awardJobService = new JobStore();
        $data = $awardJobService->storeClientJob($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function getUserJobPosts(){
        return DataTables::of(Job::query()->where('status' , Job::jobActiveId)->where('user_id', $this->getUserId())->orderBy('id', 'desc'))
            ->addColumn('action', function (Job $job) {
                return '
                <a href="#" data-toggle="modal" data-target="#editModal" onclick="edit(' . $job->id . ')"  class="btn btn-primary">Edit</a>
                <a href="' . route("client.job.details", $job->id) . '" class="btn btn-success">Details</a>
                <a href="' . route("client.job.delete", $job->id) . '" class="btn btn-danger">Delete</a>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Job $job) {
                return $job->id;
            })
            ->make(true);
    }

    public function getClientJobDetail($id){
        $job = Job::where('id' , $id)->where('user_id' , $this->getUserId())
            ->with([
                'jobBids:job_bids.id,job_bids.job_id,job_bids.user_id,job_bids.proposal,job_bids.bid_amount,job_bids.is_awarded,job_bids.created_at' ,
                'jobBids.userDetail:freelancer_detail.user_id,freelancer_detail.first_name,freelancer_detail.last_name,freelancer_detail.title,freelancer_detail.about_me',
                'jobBids.userDetail.skills:skill.id,skill.name'
            ])
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
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
use App\Repositories\BaseRepository;
use App\Services\Classes\FreelancerJobBid;
use App\Services\Classes\FreelancerJobCompletedDetail;
use App\Services\Classes\JobDetail;
use Yajra\DataTables\Facades\DataTables;
class JobRepository extends BaseRepository
{
    protected $redirect = null;
    protected $jobDetailRoute = 'freelancer.job.detail';
    protected $jobListRoute = 'freelancer.job.view';
    protected $jobDetailView = 'frontend.freelancer.job.job_detail';
    protected $jobDetailURL = "job/detail/";
    protected $appliedJobDetailURL = "applied/job/detail/";
    protected $appliedJobDetailView = "frontend.freelancer.applied_job.job_detail";
    protected $appliedJobListRoute = "freelancer.applied.job.list.view";
    protected $completedJobDetailView = "frontend.freelancer.completed_job.job_detail";
    protected $completedJobView = "frontend.freelancer.completed_job.job_list";
    protected $completedJobViewRoute = "freelancer.completed.job.list.view";

    protected $jobDetail = null;
    protected $freelancerJobBid = null;

    public function __construct(JobDetail $jobDetail , FreelancerJobBid $jobBid){
        $this->jobDetail = $jobDetail;
        $this->freelancerJobBid = $jobBid;
    }

    public function getFreelancerAppliedJobList(){
        $jobQuery = Job::query()->whereIn('id', Bids::where('user_id' , $this->getUserId())->where('is_awarded' , 0)->pluck('job_id'))->orderBy('id', 'desc');
        return DataTables::of($jobQuery)
            ->addColumn('action', function (Job $job) {
                return '<a href="' . route("freelancer.applied.job.detail", $job->id) . '" class="btn btn-success">Details</a>';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Job $job) {
                return $job->id;
            })
            ->make(true);
    }

    public function getFreelancerCompletedJobList(){
        $jobQuery = Job::query()->whereIn('id', Bids::where('user_id' , $this->getUserId())->where('is_awarded' , 1)->pluck('job_id'))->where('status' , Job::jobCompletedId)->orderBy('id', 'desc');
        return DataTables::of($jobQuery)
            ->addColumn('action', function (Job $job) {
                return '<a href="' . route("freelancer.completed.job.detail", $job->id) . '" class="btn btn-success">Details</a>';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Job $job) {
                return $job->id;
            })
            ->make(true);
    }

    public function getFreelancerCancelledJobList(){
        $jobQuery = Job::query()->whereIn('id', Bids::where('user_id' , $this->getUserId())->where('is_awarded' , 1)->pluck('job_id'))->where('status' , Job::jobCanceledId)->orderBy('id', 'desc');
        return DataTables::of($jobQuery)
            ->addColumn('action', function (Job $job) {
                return '<a href="' . route("freelancer.cancelled.job.detail", $job->id) . '" class="btn btn-success">Details</a>';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Job $job) {
                return $job->id;
            })
            ->make(true);
    }

    public function freelancerAppliedJobDetail($id){
        $data = $this->jobDetail->jobDetail($id , null, $this->getUserId());
        if($data['status'] === false){
            $this->redirect = $this->appliedJobListRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        $this->redirect = $this->appliedJobDetailView;
        return $this->redirectView($data['status'] , $data['msg'] , $data['data']);
    }

    public function jobDetail($id){
        $data = $this->jobDetail->jobDetail($id , Job::jobActiveId , $this->getUserId());
        if($data['status'] === false){
            $this->redirect = $this->jobListRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        $this->redirect = $this->jobDetailView;
        return $this->redirectView($data['status'] , $data['msg'] , $data['data']);
    }

    public function getActiveJobList(){
        $jobQuery = Job::query()->whereNotIn('id', Bids::where('user_id' , $this->getUserId())->pluck('job_id'))->where('status', Job::jobActiveId)->orderBy('id', 'desc');
        return DataTables::of($jobQuery)
            ->addColumn('action', function (Job $job) {
                return '<a href="' . route("freelancer.job.detail", $job->id) . '" class="btn btn-success">Details</a>';
            })
            ->rawColumns(['action'])
            ->setRowId(function (Job $job) {
                return $job->id;
            })
            ->make(true);
    }

    public function freelancerJobBid($data){
        $data = $this->freelancerJobBid->jobBid($data);
        $this->redirect = $this->appliedJobDetailURL.$data['data']->id;
        return $this->redirectURL($data['status'] , $data['msg']);
    }

    public function freelancerCompletedJobDetail($id){
        $jobDetail = new FreelancerJobCompletedDetail();
        $data = $jobDetail->freelancerJobCompletedDetail($id);
        if($data['status'] == false){
            $this->redirect = $this->completedJobViewRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        else{
            $this->redirect = $this->completedJobDetailView;
            return $this->redirectView($data['status'] , $data['msg'] , $data['data']);
        }
    }
}
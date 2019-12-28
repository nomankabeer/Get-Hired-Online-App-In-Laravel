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
use App\Services\Classes\JobDetail;
use Yajra\DataTables\Facades\DataTables;
class JobRepository extends BaseRepository
{
    protected $redirect = null;
    protected $jobListRoute = 'freelancer.job.view';
    protected $jobDetailView = 'frontend.freelancer.job.job_detail';
    protected $jobDetailURL = "job/detail/";
    protected $appliedJobDetailView = "frontend.freelancer.applied_job.job_detail";
    protected $appliedJobListRoute = "freelancer.applied.job.list.view";

    protected $jobDetail = null;

    public function __construct(JobDetail $jobDetail){
        $this->jobDetail = $jobDetail;
    }

    public function getFreelancerAppliedJobList(){
        $jobQuery = Job::query()->whereIn('id', Bids::where('user_id' , $this->getUserId())->pluck('job_id'))->orderBy('id', 'desc');
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
}
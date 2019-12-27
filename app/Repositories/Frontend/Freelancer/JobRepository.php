<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Freelancer;
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

    protected $jobDetail = null;

    public function __construct(JobDetail $jobDetail){
        $this->jobDetail = $jobDetail;
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
        $jobQuery = Job::query()->where('status', Job::jobActiveId)->orderBy('id', 'desc');
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
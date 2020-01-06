<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */
namespace App\Http\Controllers\Frontend\Freelancer;
use Illuminate\Http\Request;
use App\Repositories\Frontend\Freelancer\JobRepository;
use App\Http\Controllers\Controller;
class jobController extends Controller
{
    protected $jobRepository = null;
    private $jobViews = "frontend.freelancer.job";
    private $appliedJobView = "frontend.freelancer.applied_job";
    private $completedJobView = "frontend.freelancer.completed_job";
    private $cancelledJobView = "frontend.freelancer.cancelled_job";
    public function __construct(JobRepository $jobRepository){
        $this->jobRepository = $jobRepository;
    }
    public function index(){
        return view($this->jobViews.'.job_list');
    }
    public function completedJobListView(){
        return view($this->completedJobView.'.job_list');
    }
    public function cancelledJobListView(){
        return view($this->cancelledJobView.'.job_list');
    }
    public function getJobList(){
        return $this->jobRepository->getActiveJobList();
    }
    public function getJobDetail($id){
        return $this->jobRepository->jobDetail($id);
    }
    public function appliedJobListView(){
        return view($this->appliedJobView.'.job_list');
    }
    public function getAppliedJobList(){
        return $this->jobRepository->getFreelancerAppliedJobList();
    }
    public function freelancerAppliedJobDetail($id){
        return $this->jobRepository->freelancerAppliedJobDetail($id);
    }
    public function freelancerJobBid(Request $request){
        return $this->jobRepository->freelancerJobBid($request);
    }
    public function getCompletedJobList(){
        return $this->jobRepository->getFreelancerCompletedJobList();
    }
    public function getFreelancerCancelledJobList(){
        return $this->jobRepository->getFreelancerCancelledJobList();
    }
    public function freelancerCompletedJobDetail($id){
        return $this->jobRepository->freelancerCompletedJobDetail($id);
    }
}

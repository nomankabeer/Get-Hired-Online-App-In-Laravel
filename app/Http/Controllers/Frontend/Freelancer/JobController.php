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
    public function __construct(JobRepository $jobRepository){
        $this->jobRepository = $jobRepository;
    }
    public function index(){
        return view($this->jobViews.'.job_list');
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
}

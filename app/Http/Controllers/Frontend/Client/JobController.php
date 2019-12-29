<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */
namespace App\Http\Controllers\Frontend\Client;
use Illuminate\Http\Request;
use App\Repositories\Frontend\Client\JobRepository;
use App\Http\Controllers\Controller;
class jobController extends Controller
{
    protected $jobRepository = null;
    private $jobViews = "frontend.client.job";
    public function __construct(JobRepository $jobRepository){
        $this->jobRepository = $jobRepository;
    }
    public function index(){
        return view($this->jobViews.'.job_list');
    }
    public function create(){
        return view($this->jobViews.'.job_post');
    }
    public function store(Request $request) {
        return $this->jobRepository->storeJobData($request->all());
    }
    public function getJobList(){
        return $this->jobRepository->getUserJobPosts();
    }
    public function getJobDetail($id){
        return $this->jobRepository->getClientJobDetail($id);
    }
    public function awardJobBid($job_id , $bid_id){
        return $this->jobRepository->awardUserBidForJob($job_id , $bid_id);
    }
}

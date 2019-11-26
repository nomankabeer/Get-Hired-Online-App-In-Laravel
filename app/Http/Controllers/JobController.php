<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\JobRepository;
class jobController extends Controller
{
    protected $jobRepository = null;
    public function __construct(JobRepository $jobRepository){
        $this->jobRepository = $jobRepository;
    }
    public function index(){
        return view('frontend.client.job_list');
    }
    public function create(){
        return view('frontend.client.job_post');
    }
    public function store(Request $request) {
        return $this->jobRepository->storeJobData($request->all());
    }
    public function show($id){
        //
    }
    public function edit($id){
        //
    }
    public function update(Request $request, $id){
        //
    }
    public function destroy($id){
        //
    }
    public function getJobList(){
        return $this->jobRepository->getUserJobPosts();
    }
    public function getJobDetail($id){
        return $this->jobRepository->getUSerJobDetail($id);
    }
}

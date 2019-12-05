<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Order;
use App\Repositories\Frontend\Client\SearchRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Client\OrderRepository;
class SearchFreelancerController extends Controller
{
    protected $searchRepository = null;
    public function __construct(SearchRepository $searchRepository){
    $this->searchRepository = $searchRepository;
    }

    public function index(){
        $data['skills'] = $this->searchRepository->getSkills();
        return view('frontend.client.search_freelancer.search' , compact('data'));
    }

    public function search(Request $request){
        return $this->searchRepository->getSearchResultsForFreelancer($request->all());
    }

    public function getFreelancerProfile($name){
        return $this->searchRepository->getFreelancerProfile($name);
    }
}

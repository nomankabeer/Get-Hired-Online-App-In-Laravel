<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */
namespace App\Http\Controllers\Frontend\Freelancer;
use Illuminate\Http\Request;
use Auth;
use App\Repositories\Frontend\Freelancer\BidRepository;
use App\Http\Controllers\Controller;
use App\Repositories\Traits\FreelancerProfileTrait;
class FreelancerController extends Controller
{
    use FreelancerProfileTrait;
    protected $bidRepository = null;
    public function __construct(BidRepository $bidRepository){
        $this->bidRepository = $bidRepository;
    }

    public function profile(){
        $data = $this->getFreelancerProfileData(Auth::user()->name)['data'];
        return view('frontend.freelancer.profile.profile' , compact('data'));
    }

    public function updateTitleAndProfileImage(Request $request){

    }
}

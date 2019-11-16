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
use App\Repositories\Frontend\Client\ServiceProviders\Order\OrderDetail;
use App\Repositories\Frontend\Client\ServiceProviders\Order\OrderReviewServiceProvider;
use App\Repositories\Frontend\Client\ServiceProviders\Order\StoreOrderService;
use App\Repositories\Frontend\Client\ServiceProviders\Order\UpdateOrderDeliveryStatus;
use App\Skill;
use App\User;
use App\FreelancerDetail;
use App\FreelancerSkill;
use App\Repositories\Traits\FreelancerProfileTrait;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class SearchRepository extends BaseRepository
{
    use FreelancerProfileTrait;
    protected $redirect = null;
    protected $searchResultView = "frontend.client.search_freelancer.search";
    protected $freelancerProfileView = "frontend.client.search_freelancer.profile";
    protected $searchFreelancerRoute = "client.search.freelancer";

    public function getSkills(){
        return Skill::select('id' , 'name')->get();
    }

    public function getSearchResultsForFreelancer($data){
        $skill = $this->validateRequestSkill($data);
        $data = $this->applySearchFilters($skill , $data['title']);
        if($data->count() > 0){
            $status = true;
            $msg = ['Freelancer found'];
        }
        else{
            $status = false;
            $msg = ['No Freelancer Found'];
        }
        $this->redirect = $this->searchResultView;
        $returnData = array('skills' => $this->getSkills() , 'data' => $data);
        return $this->redirectView($status , $msg  , $returnData);
    }

    public function getFreelancerProfile($name){
        $data = $this->getFreelancerProfileData($name);
        if($data['status'] === false){
            $this->redirect = $this->searchFreelancerRoute;
            return $this->redirectRoute($data['status'] , $data['msg']);
        }
        else{
            $this->redirect = $this->freelancerProfileView;
            return $this->redirectView($data['status'] , $data['msg']  , $data['data']);
        }
    }

    private function validateRequestSkill($data){
        return !isset($data['skill']) ? $data['skill'] = array() : $data['skill'];
    }
    private function applySearchFilters($skill , $title){
        $query = FreelancerDetail::whereIn('user_id' , FreelancerSkill::whereIn('skill_id' , $skill)->distinct()->pluck('user_id'));
        if($title != null){
            $query->orWhere('title', 'LIKE', '%'.$title.'%');
        }
        return $query->with(['skills:skill.name,skill.id' ,'userName:users.name,users.id'])->get();
    }

}
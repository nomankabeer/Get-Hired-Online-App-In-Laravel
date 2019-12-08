<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Freelancer;
use App\Repositories\BaseRepository;
use App\Repositories\ServiceProviders\Classes\FreelancerAddEducation;
use App\Repositories\ServiceProviders\Classes\FreelancerProfileUpdateTitleAndImageServiceProvider;
use App\User;
use App\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Traits\UploadFileTrait;
use App\Repositories\Traits\FreelancerProfileTrait;
class FreelancerProfileRepository extends BaseRepository
{
    use UploadFileTrait , FreelancerProfileTrait;
    protected $redirect = null;
    protected $addEducation = null;
    protected $freelancerProfileRoute = 'freelancer.profile';
    protected $freelancerProfileView = 'frontend.freelancer.profile.profile';

    public function __construct(FreelancerAddEducation $addEducation){
        $this->addEducation = $addEducation;
    }

    public function updateProfileImgAndTitle($data){
        $updateProfile = new FreelancerProfileUpdateTitleAndImageServiceProvider();
        $updated_data = $updateProfile->updateFreelancerProfileImgAndTitle($data , $this->getUserId());
        $this->redirect = $this->freelancerProfileRoute;
        return $this->redirectRoute($updated_data['status'] , $updated_data['msg']);
    }

    public function getFreelancerProfile(){
        $data = $this->getFreelancerProfileData(Auth::user()->name)['data'];
        $this->redirect = $this->freelancerProfileView;
        return $this->redirectView(true  , [] , $data);
    }

    public function addFreelancerEducation($data){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->addEducation->addEducation($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }
}
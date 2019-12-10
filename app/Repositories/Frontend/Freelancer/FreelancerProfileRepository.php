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
use App\Repositories\ServiceProviders\Classes\FreelancerDeleteEducation;
use App\Repositories\ServiceProviders\Classes\FreelancerProfileUpdateTitleAndImageServiceProvider;
use App\Repositories\ServiceProviders\Classes\FreelancerUpdateEducation;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Traits\UploadFileTrait;
use App\Repositories\Traits\FreelancerProfileTrait;
class FreelancerProfileRepository extends BaseRepository
{
    use UploadFileTrait , FreelancerProfileTrait;
    protected $redirect = null;
    protected $addEducation = null;
    protected $updateEducation = null;
    protected $deleteEducation = null;
    protected $updateProfile = null;
    protected $freelancerProfileRoute = 'freelancer.profile';
    protected $freelancerProfileView = 'frontend.freelancer.profile.profile';

    public function __construct(
        FreelancerAddEducation $addEducation ,
        FreelancerProfileUpdateTitleAndImageServiceProvider $updateProfile ,
        FreelancerUpdateEducation $updateEducation ,
        FreelancerDeleteEducation $deleteEducation )
    {
        $this->addEducation = $addEducation;
        $this->updateProfile = $updateProfile;
        $this->updateEducation = $updateEducation;
        $this->deleteEducation = $deleteEducation;
    }

    public function updateProfileImgAndTitle($data){
        $updated_data = $this->updateProfile->updateFreelancerProfileImgAndTitle($data);
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

    public function updateFreelancerEducation($data){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->updateEducation->updateEducation($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function deleteFreelancerEducation($id){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->deleteEducation->deleteEducation($id);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Freelancer;
use App\Repositories\BaseRepository;
use App\Services\Classes\FreelancerAddEducation;
use App\Services\Classes\FreelancerAddExperience;
use App\Services\Classes\FreelancerDeleteEducation;
use App\Services\Classes\FreelancerDeleteExperience;
use App\Services\Classes\FreelancerProfileUpdateTitleAndImageServiceProvider;
use App\Services\Classes\FreelancerUpdateAboutMe;
use App\Services\Classes\FreelancerUpdateEducation;
use App\Services\Classes\FreelancerUpdateExperience;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Traits\UploadFileTrait;
use App\Repositories\Traits\FreelancerProfileTrait;
use App\Services\Classes\FreelancerAddSkill;
use App\Services\Classes\FreelancerUpdateSkill;
use App\Services\Classes\FreelancerDeleteSkill;
class FreelancerProfileRepository extends BaseRepository
{
    use UploadFileTrait , FreelancerProfileTrait;
    protected $redirect = null;
    protected $addEducation = null;
    protected $updateEducation = null;
    protected $deleteEducation = null;
    protected $addExperience = null;
    protected $updateExperience = null;
    protected $deleteExperience = null;
    protected $updateProfile = null;
    protected $updateAboutMe = null;
    protected $freelancerProfileRoute = 'freelancer.profile';
    protected $freelancerProfileView = 'frontend.freelancer.profile.profile';

    public function __construct(
        FreelancerAddEducation $addEducation ,
        FreelancerUpdateEducation $updateEducation ,
        FreelancerDeleteEducation $deleteEducation,
        FreelancerAddExperience $addExperience ,
        FreelancerUpdateExperience $updateExperience,
        FreelancerDeleteExperience $deleteExperience,
        FreelancerUpdateAboutMe $updateAboutMe,
        FreelancerAddSkill $addSkill,
        FreelancerUpdateSkill $updateSkill,
        FreelancerDeleteSkill $deleteSkill
    )
    {
        $this->addEducation = $addEducation;
        $this->updateEducation = $updateEducation;
        $this->deleteEducation = $deleteEducation;
        $this->addExperience = $addExperience;
        $this->updateExperience = $updateExperience;
        $this->deleteExperience = $deleteExperience;
        $this->updateAboutMe = $updateAboutMe;
        $this->addSkill = $addSkill;
        $this->updateSkill = $updateSkill;
        $this->deleteSkill = $deleteSkill;
    }

    public function updateProfileImgAndTitle($data){
        $updated_data = FreelancerProfileUpdateTitleAndImageServiceProvider::updateFreelancerProfileImgAndTitle($data);
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

    public function addFreelancerExperience($data){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->addExperience->addExperience($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function updateFreelancerExperience($data){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->updateExperience->updateExperience($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function deleteFreelancerExperience($id){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->deleteExperience->deleteExperience($id);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function updateFreelancerAboutMe($data){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->updateAboutMe->updateAboutMe($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function addFreelancerSkill($data){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->addSkill->addSkill($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function updateFreelancerSkill($data){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->updateSkill->updateSkill($data);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

    public function deleteFreelancerSkill($id){
        $this->redirect = $this->freelancerProfileRoute;
        $data = $this->deleteSkill->deleteSkill($id);
        return $this->redirectRoute($data['status'] , $data['msg']);
    }

}
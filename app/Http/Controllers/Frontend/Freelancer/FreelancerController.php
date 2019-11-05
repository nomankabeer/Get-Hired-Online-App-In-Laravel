<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */
namespace App\Http\Controllers\Frontend\Freelancer;
use App\Repositories\Frontend\Freelancer\FreelancerProfileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FreelancerController extends Controller
{
    protected $freelancerProfileRepository = null;
    public function __construct(FreelancerProfileRepository $freelancerProfileRepository){
        $this->freelancerProfileRepository = $freelancerProfileRepository;
    }

    public function profile(){
        return $this->freelancerProfileRepository->getFreelancerProfile();
    }

    public function updateAboutMe(Request $request){
        return $this->freelancerProfileRepository->updateFreelancerAboutMe($request);
    }

    public function updateTitleAndProfileImage(Request $request){
        return $this->freelancerProfileRepository->updateProfileImgAndTitle($request);
    }
    public function addEducation(Request $request){
        return $this->freelancerProfileRepository->addFreelancerEducation($request->all());
    }

    public function updateEducation(Request $request){
        return $this->freelancerProfileRepository->updateFreelancerEducation($request->all());
    }

    public function deleteEducation($id){
        return $this->freelancerProfileRepository->deleteFreelancerEducation($id);
    }

    public function addExperience(Request $request){
        return $this->freelancerProfileRepository->addFreelancerExperience($request->all());
    }

    public function updateExperience(Request $request){
        return $this->freelancerProfileRepository->updateFreelancerExperience($request->all());
    }

    public function deleteExperience($id){
        return $this->freelancerProfileRepository->deleteFreelancerExperience($id);
    }

    public function addSkill(Request $request){
        return $this->freelancerProfileRepository->addFreelancerSkill($request->all());
    }

    public function updateSkill(Request $request){
        return $this->freelancerProfileRepository->updateFreelancerSkill($request->all());
    }

    public function deleteSkill($id){
        return $this->freelancerProfileRepository->deleteFreelancerSkill($id);
    }
}

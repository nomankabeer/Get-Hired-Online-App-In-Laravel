<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Services\BaseService;
use App\Services\Traits\UploadServicesFileTrait;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\Interfaces\FreelancerUpdateProfile;
class FreelancerProfileUpdateTitleAndImageServiceProvider extends BaseService implements FreelancerUpdateProfile
{
    use UploadServicesFileTrait;
    public static function updateFreelancerProfileImgAndTitle($data){
        $user = Auth::user();
        $msg = array();
        $status = false;
        if($user != null){
                self::validateTitle($data->all())->validate();
                $user->userDetail->title = $data->title;
                $user->userDetail->first_name = $data->first_name;
                $user->userDetail->last_name = $data->last_name;
                $user->userDetail->update();
                $msg[] = 'Profile Successfully updated';
                $status = true;
            if($data->hasFile('image') === true){
                self::validateImage($data->all())->validate();
                $image = self::uploadImage($data->file('image') , 'images/userProfile');
                $user->avatar = $image;
                $user->update();
                $msg[] = 'Profile image Successfully updated';
                $status = true;
            }
        }else{
            $msg[] = 'User not found';
        }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }

    private static function validateTitle($data){
        return Validator::make($data, [
            'title' => ['required', 'string', 'min:10' , 'max:40'],
            'first_name' => ['required', 'string', 'min:3' , 'max:20'],
            'last_name' => ['required', 'string', 'min:3' , 'max:20'],
        ]);
    }
    private static function validateImage($data){
        return Validator::make($data, [
            'image' => ['required','mimes:jpeg,jpg,png' , 'max:2048'],
        ]);
    }
}
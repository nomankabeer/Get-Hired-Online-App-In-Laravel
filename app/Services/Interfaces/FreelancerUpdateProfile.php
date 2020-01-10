<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 03-Dec-2019
 * Time: 8:05 AM
 */

namespace App\Services\Interfaces;
interface FreelancerUpdateProfile
{
    public static function updateFreelancerProfileImgAndTitle($UserTitleFirstNameLastNameAndProfileImage);
}
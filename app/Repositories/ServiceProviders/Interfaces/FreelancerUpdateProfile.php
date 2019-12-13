<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 03-Dec-2019
 * Time: 8:05 AM
 */

namespace App\Repositories\ServiceProviders\Interfaces;
interface FreelancerUpdateProfile
{
    public function updateFreelancerProfileImgAndTitle($UserTitleFirstNameLastNameAndProfileImage);
}
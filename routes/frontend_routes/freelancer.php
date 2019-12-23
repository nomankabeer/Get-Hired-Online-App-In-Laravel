<?php
/*
 * repository design pattern
 * yajra data tables
 * soft deletes
 * multiple role base app
 * email , redis , queues
 * payment method  , cashier
 * socialite
 *
 * */

//prefix as freelancer.

    Route::get('profile' , 'FreelancerController@profile')->name('profile');

    //Update Profile
    Route::post('update/title/profileImage' ,'FreelancerController@updateTitleAndProfileImage')->name('update.title.and.profile.image');

    Route::post('update/about/me' ,'FreelancerController@updateAboutMe')->name('update.about_me');

    Route::post('add/experience' ,'FreelancerController@addExperience')->name('add.experience');
    Route::put('update/experience' ,'FreelancerController@updateExperience')->name('update.experience');
    Route::get('delete/experience/{id}' ,'FreelancerController@deleteExperience')->name('delete.experience');

    Route::post('add/education' ,'FreelancerController@addEducation')->name('add.education');
    Route::put('update/education' ,'FreelancerController@updateEducation')->name('update.education');
    Route::get('delete/education/{id}' ,'FreelancerController@deleteEducation')->name('delete.education');

    Route::get('delete/skill/{id}' ,'FreelancerController@deleteSkill')->name('delete.skill');
    Route::post('add/skill' ,'FreelancerController@addSkill')->name('add.skill');
    Route::put('update/skill' ,'FreelancerController@updateSkill')->name('update.skill');

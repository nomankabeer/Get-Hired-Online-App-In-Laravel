<?php
/**
 * prefix as freelancer.
 * namespace as freelancer.
 *
 * */

//  freelancer profile
    Route::get('profile' , 'FreelancerController@profile')->name('profile');

//  Update Profile routes
    Route::post('update/title/profileImage' ,'FreelancerController@updateTitleAndProfileImage')->name('update.title.and.profile.image');
    Route::post('update/about/me' ,'FreelancerController@updateAboutMe')->name('update.about_me');

//  experience routes
    Route::post('add/experience' ,'FreelancerController@addExperience')->name('add.experience');
    Route::put('update/experience' ,'FreelancerController@updateExperience')->name('update.experience');
    Route::get('delete/experience/{id}' ,'FreelancerController@deleteExperience')->name('delete.experience');

//  education routes
    Route::post('add/education' ,'FreelancerController@addEducation')->name('add.education');
    Route::put('update/education' ,'FreelancerController@updateEducation')->name('update.education');
    Route::get('delete/education/{id}' ,'FreelancerController@deleteEducation')->name('delete.education');

//  skill routes
    Route::post('add/skill' ,'FreelancerController@addSkill')->name('add.skill');
    Route::put('update/skill' ,'FreelancerController@updateSkill')->name('update.skill');
    Route::get('delete/skill/{id}' ,'FreelancerController@deleteSkill')->name('delete.skill');

//  job routes for freelancer
    Route::get('jobs' , 'JobController@index')->name('job.view');
    Route::get('jobs/list' , 'JobController@getJobList')->name('job.list');
    Route::get('job/detail/{id}' , 'JobController@getJobDetail')->name('job.detail')->where('id' , '[0-9]+');

//  applied job routes
    Route::get('applied/job/list' , 'JobController@appliedJobListView')->name('applied.job.list.view');
    Route::get('get/applied/jobs' , 'JobController@getAppliedJobList')->name('applied.job.list');
    Route::get('applied/job/detail/{id}' , 'JobController@freelancerAppliedJobDetail')->name('applied.job.detail')->where('id' , '[0-9]+');

//  completed job routed for freelancer
    Route::get('completed/job/list' , 'JobController@completedJobListView')->name('completed.job.list.view');
    Route::get('get/completed/jobs' , 'JobController@getCompletedJobList')->name('completed.job.list');
    Route::get('completed/job/detail/{id}' , 'JobController@freelancerCompletedJobDetail')->name('completed.job.detail')->where('id' , '[0-9]+');

//  cancelled job routed for freelancer
    Route::get('cancelled/job/list' , 'JobController@cancelledJobListView')->name('cancelled.job.list.view');
    Route::get('get/cancelled/jobs' , 'JobController@getFreelancerCancelledJobList')->name('cancelled.job.list');
    Route::get('cancelled/job/detail/{id}' , 'JobController@freelancerCompletedJobDetail')->name('cancelled.job.detail')->where('id' , '[0-9]+');

//  Active order routes
    Route::get('active/order/list' , 'OrderController@activeOrderListView')->name('active.order.list.view');
    Route::get('active/order/list/data' , 'OrderController@activeOrderList')->name('active.order.list.data');
    Route::get('active/order/detail/{id}' , 'OrderController@activeOrderDetail')->name('active.order.detail');
    Route::post('order/review' , 'OrderController@freelancerOrderReview')->name('order.review');

//  order delivery route
    Route::post('order/delivery' , 'OrderController@orderDelivery')->name('order.delivery');

//  job bid route
    Route::post('job/bid' , 'JobController@freelancerJobBid')->name('job.bid');

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
Auth::routes();

Route::get('', 'HomeController@index')->name('home');
Route::redirect('/home' , '/');

Route::group([
    'namespace' => 'freelancer',
    'prefix' => 'freelancer',
],function(){

});

Route::group([
    'namespace' => 'Frontend\Client',
    'middleware' => ['client' , 'account_status'],
    'as' => 'client.'
],function(){

    Route::get('job/detail/{id}' , 'JobController@getJobDetail')->name('job.detail')->where('id' , '[0-9]+');
    Route::get('job/delete/{id}' , 'JobController@getJobList')->name('job.delete')->where('id' , '[0-9]+');
    Route::get('job/list/data' , 'JobController@getJobList')->name('job.list.data');
    Route::get('job/list' , 'JobController@index')->name('job.list');
    Route::get('job/post' , 'JobController@create')->name('job.post');
    Route::post('job/post' , 'JobController@store')->name('job.post');

    Route::get('job/award/{job_id}/{bid_id}' , 'JobController@awardJobBid')->name('job.award')->where('bid_id' , '[0-9]+')->where('job_id' , '[0-9]+');

    Route::get('order/list/data', 'OrderController@getOrderList')->name('order.list.data');
    Route::get('order/list', 'OrderController@index')->name('order.list');

    Route::get('order/detail/{id}', 'OrderController@orderDetail')->name('order.detail')->where('id' , '[0-9]+');
    Route::get('order/update/delivery/status/{order_deliver_id}/{status}', 'OrderController@orderUpdateDeliveryStatus')->name('order.update.delivery.status')->where('order_deliver_id' , '[0-9]+')->where('status' , '[0-9]+');

    Route::post('client/order/review' , 'OrderController@orderReview')->name('order.review');

    Route::get('search/freelancer/{name}' , 'SearchFreelancerController@getFReelancerProfile')->name('search.freelancer.profile');
    Route::get('search/freelancer' , 'SearchFreelancerController@index')->name('search.freelancer');
    Route::post('search/freelancer' , 'SearchFreelancerController@search')->name('search.freelancer');

    /*Route::get('get' , function(){
        App\OrderDelivery::whereIn('id' , [1 , 2])->update(['status' => 1]);
    });*/

});

Route::group([
    'namespace' => 'admin',
    'prefix' => 'admin',
],function(){

});


Route::group([
    'namespace' => 'Frontend\Freelancer',
    'middleware' => ['freelancer' , 'account_status'],
    'as' => 'freelancer.'
],function(){
    Route::get('profile' , 'FreelancerController@profile')->name('profile');

    //Update Profile
    Route::post('update/title/profileImage' ,'FreelancerController@updateTitleAndProfileImage')->name('update.title.and.profile.image');

    Route::post('add/education' ,'FreelancerController@addEducation')->name('add.education');
    Route::put('update/education' ,'FreelancerController@updateEducation')->name('update.education');
    Route::get('delete/education/{id}' ,'FreelancerController@deleteEducation')->name('delete.education');


});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout')->middleware('auth');






//client routes
Route::view('client/index' , 'client/index')->name('index');

Route::view('job/detail' , 'client/job_detail')->name('job.detail');
Route::view('job/edit' , 'add_job')->name('job.edit');
Route::view('job/delete' , 'add_job')->name('job.delete');
Route::view('user/profile' , 'user_profile');



//freelancer routes
Route::view('freelancer/index' , 'freelancer/index')->name('index');
Route::view('freelancer/profile' , 'freelancer/profile')->name('index');
//Route::view('job/detail' , 'add_job')->name('job.detail');



<?php
Auth::routes();

Route::group([
    'namespace' => 'freelancer',
    'prefix' => 'freelancer',
],function(){

});

Route::group([
    'namespace' => 'client',
    'prefix' => 'client',
],function(){

});

Route::group([
    'namespace' => 'admin',
    'prefix' => 'admin',
],function(){

});










//client routes
Route::view('client/index' , 'client/index')->name('index');
Route::view('add/job' , 'client/add_job')->name('post.job');
Route::view('job/detail' , 'client/job_detail')->name('job.detail');
Route::view('job/edit' , 'add_job')->name('job.edit');
Route::view('job/delete' , 'add_job')->name('job.delete');
Route::view('user/profile' , 'user_profile');



//freelancer routes
Route::view('freelancer/index' , 'freelancer/index')->name('index');
Route::view('freelancer/profile' , 'freelancer/profile')->name('index');
//Route::view('job/detail' , 'add_job')->name('job.detail');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

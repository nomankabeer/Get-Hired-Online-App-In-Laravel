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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout')->middleware('auth');






//client routes
/*Route::view('client/index' , 'client/index')->name('index');

Route::view('job/detail' , 'client/job_detail')->name('job.detail');
Route::view('job/edit' , 'add_job')->name('job.edit');
Route::view('job/delete' , 'add_job')->name('job.delete');
Route::view('user/profile' , 'user_profile');*/



//freelancer routes
//Route::view('freelancer/index' , 'freelancer/index')->name('index');
//Route::view('freelancer/profile' , 'freelancer/profile')->name('index');
//Route::view('job/detail' , 'add_job')->name('job.detail');



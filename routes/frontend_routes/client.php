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

//namespace frontend/client
//prefix as client.


    Route::get('job/details/{id}' , 'JobController@getJobDetail')->name('job.details')->where('id' , '[0-9]+');
    Route::get('job/delete/{id}' , 'JobController@getJobList')->name('job.delete')->where('id' , '[0-9]+');
    Route::get('job/list/data' , 'JobController@getJobList')->name('job.list.data');
    Route::get('job/list' , 'JobController@index')->name('job.list');
    Route::get('job/post' , 'JobController@create')->name('job.post');
    Route::post('job/post' , 'JobController@store')->name('job.post');

    Route::get('job/award/{job_id}/{bid_id}' , 'JobController@awardJobBid')->name('job.award')->where('bid_id' , '[0-9]+')->where('job_id' , '[0-9]+');

    Route::get('order/list/data', 'OrderController@getOrderList')->name('order.list.data');
    Route::get('orders/list', 'OrderController@index')->name('orders.list');

    Route::get('order/detail/{id}', 'OrderController@orderDetail')->name('order.detail')->where('id' , '[0-9]+');
    Route::get('order/update/delivery/status/{order_deliver_id}/{status}', 'OrderController@orderUpdateDeliveryStatus')->name('order.update.delivery.status')->where('order_deliver_id' , '[0-9]+')->where('status' , '[0-9]+');

    Route::post('client/order/review' , 'OrderController@orderReview')->name('order.review');

    Route::get('search/freelancer/{name}' , 'SearchFreelancerController@getFReelancerProfile')->name('search.freelancer.profile');
    Route::get('search/freelancer' , 'SearchFreelancerController@index')->name('search.freelancer');
    Route::post('search/freelancer' , 'SearchFreelancerController@search')->name('search.freelancer');

    /*Route::get('get' , function(){
        App\OrderDelivery::whereIn('id' , [1 , 2])->update(['status' => 1]);
    });*/

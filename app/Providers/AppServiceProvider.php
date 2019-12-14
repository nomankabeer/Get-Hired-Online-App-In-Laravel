<?php

namespace App\Providers;

use App\Order;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\OrderDelivery;
use View;
class AppServiceProvider extends ServiceProvider
{
    public function register(){
    }
    public function boot()
    {
        View::share('clientRoleId', User::clientRoleId);
        View::share('freelancerRoleId', User::freelancerRoleId);

        View::share('orderDeliveryStatusPendingId', OrderDelivery::orderDeliveryStatusPendingId);
        View::share('orderDeliveryStatusAcceptedId', OrderDelivery::orderDeliveryStatusAcceptedId);
        View::share('orderDeliveryStatusRejectedId', OrderDelivery::orderDeliveryStatusRejectedId);

        View::share('orderCompletedId', Order::orderCompletedId);
    }
}

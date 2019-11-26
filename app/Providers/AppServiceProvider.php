<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('clientRoleId', User::clientRoleId);
        View::share('freelancerRoleId', User::freelancerRoleId);
    }
}

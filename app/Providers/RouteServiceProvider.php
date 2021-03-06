<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));

        Route::group([
            'namespace' => $this->namespace.'\Frontend\Client',
            'middleware' => ['web' , 'client' , 'account_status'],
            'as' => 'client.'],
            base_path('routes/frontend_routes/client.php')
        );

        Route::group([
            'namespace' => $this->namespace.'\Frontend\Freelancer',
            'middleware' => ['web' , 'freelancer' , 'account_status'],
            'as' => 'freelancer.'] ,
            base_path('routes/frontend_routes/freelancer.php')
        );

        Route::group([
            'namespace' => $this->namespace.'\Backend\Admin',
            'middleware' => ['web' , 'admin'],
            'as' => 'admin.'] ,
            base_path('routes/backend_routes/admin.php')
        );
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}

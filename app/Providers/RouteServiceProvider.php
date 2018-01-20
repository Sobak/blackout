<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapPublicRoutes();
    }

    /**
     * Define the "public" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc
     * but are not protected with any kind of authorization.
     *
     * @return void
     */
    protected function mapPublicRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/public.php'));
    }
}

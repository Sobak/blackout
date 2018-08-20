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

        $this->mapGameRoutes();

        $this->mapAdminRoutes();
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

    /**
     * Define the "game" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc
     * and require authorization.
     *
     * @return void
     */
    protected function mapGameRoutes()
    {
        Route::middleware(['web', 'auth', 'is.game.closed', 'is.user.banned', 'planet.switch'])
             ->namespace($this->namespace)
             ->group(base_path('routes/game.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection but will
     * be protected against regular-level users.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware(['web', 'auth'])
             ->namespace($this->namespace . '\Admin')
             ->prefix('admin')
             ->group(base_path('routes/admin.php'));
    }
}

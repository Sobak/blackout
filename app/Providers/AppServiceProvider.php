<?php

namespace App\Providers;

use App\Http\Composers\BaseComposer;
use App\Http\Composers\TopbarComposer;
use App\Models\Config as ConfigModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Ignore notices for now :/
        error_reporting(E_ALL ^ E_NOTICE);

        // Expose all game settings within default Laravel config repository
        if ($this->app->runningInConsole() === false && file_exists(base_path('.env')) && filesize(base_path('.env')) > 0) {
            foreach (ConfigModel::pluck('config_value', 'config_name') as $configName => $configValue) {
                Config::set("blackout.$configName", $configValue);
            }
        }

        // Bind view composers
        View::composer('base', BaseComposer::class);
        View::composer('partials.topbar', TopbarComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

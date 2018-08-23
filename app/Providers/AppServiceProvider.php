<?php

namespace App\Providers;

use App\Models\Config as ConfigModel;
use Illuminate\Support\Facades\Config;
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
        foreach (ConfigModel::pluck('config_value', 'config_name') as $configName => $configValue) {
            Config::set("blackout.$configName", $configValue);
        }
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

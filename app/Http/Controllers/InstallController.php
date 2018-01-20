<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Galaxy;
use App\Models\Planet;
use App\Models\User;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config as ConfigFacade;
use Illuminate\Support\Facades\DB;

class InstallController extends Controller
{
    public function intro()
    {
        if (file_exists(base_path('.env'))) {
            return redirect()->to('/');
        }

        return view('install.intro', [
            'form_action' => route('install.database'),
            'step' => 1,
            'title' => trans('install.title'),
        ]);
    }

    public function database()
    {
        return view('install.database', [
            'form_action' => route('install.database'),
            'step' => 2,
            'title' => trans('install.title'),
        ]);
    }

    public function databasePost(Request $request)
    {
        // Test database connection using data from the previous step
        config()->set('database.connections.mysql.host', $request->get('host'));
        config()->set('database.connections.mysql.database', $request->get('database'));
        config()->set('database.connections.mysql.username', $request->get('username'));
        config()->set('database.connections.mysql.password', $request->get('password'));
        config()->set('database.connections.mysql.prefix', $request->get('prefix'));

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('install.database.error'));
        }

        // Create .env file
        $configTemplate = file_get_contents(base_path('.env.example'));

        $appKey = 'base64:' . base64_encode(Encrypter::generateKey(config('app.cipher')));

        $config = strtr($configTemplate, [
            '{{app_key}}' => $appKey,
            '{{db_host}}' => $request->get('host'),
            '{{db_database}}' => $request->get('database'),
            '{{db_username}}' => $request->get('username'),
            '{{db_password}}' => $request->get('password'),
            '{{db_prefix}}' => $request->get('prefix'),
        ]);

        file_put_contents(base_path('.env'), $config);

        // Migrate the database
        Artisan::call('migrate', ['--force' => true]);

        // Set localized config values
        Config::where('config_name', 'close_reason')
              ->update(['config_value' => trans('database.close_reason')]);
        Config::where('config_name', 'OverviewNewsText')
              ->update(['config_value' => trans('database.news_text')]);

        // Show the page
        return view('install.database_done', [
            'form_action' => route('install.account'),
            'step' => 2,
            'title' => trans('install.title'),
        ]);
    }

    public function account()
    {
        return view('install.account', [
            'form_action' => route('install.account'),
            'step' => 3,
            'title' => trans('install.title'),
        ]);
    }

    public function accountPost(Request $request)
    {
        User::unguard();
        User::create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'email_2' => $request->get('email'),
            'lang' => config('app.locale'),
            'dpath' => 'xnova', // @todo fixme
            'authlevel' => 3,
            'id_planet' => 1,
            'galaxy' => 1,
            'system' => 1,
            'planet' => 1,
            'current_planet' => 1,
            'register_time' => time(),
            'password' => md5($request->get('password')),
        ]);

        Planet::unguard();
        Planet::create([
            'name' => $request->get('planet'),
            'id_owner' => 1,
            'id_level' => 1,
            'galaxy' => 1,
            'system' => 1,
            'planet' => 1,
            'last_update' => time(),
            'planet_type' => 1,
            'image' => 'normaltempplanet02',
            'diameter' => 12750,
            'field_max' => 163,
            'temp_min' => 47,
            'temp_max' => 87,
            'metal' => 500,
            'metal_perhour' => 0,
            'metal_max' => 1000000,
            'crystal' => 500,
            'crystal_perhour' => 0,
            'crystal_max' => 1000000,
            'deuterium' => 500,
            'deuterium_perhour' => 0,
            'deuterium_max' => 1000000,
        ]);

        Galaxy::unguard();
        Galaxy::create([
            'galaxy' => 1,
            'system' => 1,
            'planet' => 1,
            'id_planet' => 1,
        ]);

        Config::where('config_name', 'LastSettedGalaxyPos')->update(['config_value' => 1]);
        Config::where('config_name', 'LastSettedSystemPos')->update(['config_value' => 1]);
        Config::where('config_name', 'LastSettedPlanetPos')->update(['config_value' => 1]);

        // Show the page
        return view('install.account_done', [
            'form_action' => route('install.account'),
            'step' => 3,
            'title' => trans('install.title'),
        ]);
    }
}

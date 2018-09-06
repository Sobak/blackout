<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function index()
    {
        return view('admin.options.index', [
            'config' => config('blackout'),
            'title' => trans('admin/options.title'),
        ]);
    }

    public function update(Request $request)
    {
        $config = [
            'game_disable' => (int) $request->has('game_disable'),
            'close_reason' => $request->get('close_reason') ?? '',
            'game_name' => $request->get('game_name') ?? '',
            'forum_url' => $request->get('forum_url') ?? '',
            'game_speed' => is_numeric($request->get('game_speed')) ? $request->get('game_speed') : config('blackout.game_speed'),
            'fleet_speed' => is_numeric($request->get('fleet_speed')) ? $request->get('fleet_speed') : config('blackout.fleet_speed'),
            'resource_multiplier' => is_numeric($request->get('resource_multiplier')) ? $request->get('resource_multiplier') : config('blackout.resource_multiplier'),
            'OverviewNewsFrame' => (int) $request->has('newsframe'),
            'OverviewNewsText' => $request->get('NewsText') ?? '',
            'OverviewExternChat' => (int) $request->has('chatframe'),
            'OverviewExternChatCmd' => $request->get('ExternChat') ?? '',
            'OverviewBanner' => (int) $request->has('googlead'),
            'OverviewClickBanner' => $request->get('GoogleAds') ?? '',
            'initial_fields' => is_numeric($request->get('initial_fields')) ? $request->get('initial_fields') : config('blackout.initial_fields'),
            'metal_basic_income' => is_numeric($request->get('metal_basic_income')) ? $request->get('metal_basic_income') : config('blackout.metal_basic_income'),
            'crystal_basic_income' => is_numeric($request->get('crystal_basic_income')) ? $request->get('crystal_basic_income') : config('blackout.crystal_basic_income'),
            'deuterium_basic_income' => is_numeric($request->get('deuterium_basic_income')) ? $request->get('deuterium_basic_income') : config('blackout.deuterium_basic_income'),
            'energy_basic_income' => is_numeric($request->get('energy_basic_income')) ? $request->get('energy_basic_income') : config('blackout.energy_basic_income'),
            'debug' => (int) $request->has('debug'),
            'urlaubs_modus_erz' => (int) $request->has('urlaubs_modus_erz'),
        ];

        foreach ($config as $configName => $configValue) {
            Config::where('config_name', $configName)->update(['config_value' => $configValue]);
        }

        return show_message(
            trans('admin/options.success_text'),
            trans('admin/options.success_title'),
            route('admin.options')
        );
    }
}

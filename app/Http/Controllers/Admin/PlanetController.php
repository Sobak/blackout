<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planet;

class PlanetController extends Controller
{
    public function index()
    {
        $planets = Planet::where('planet_type', 1)->get();

        return view('admin.planet.index', [
            'planets' => $planets,
            'title' => trans('admin/planet.index.title'),
        ]);
    }

    public function active()
    {
        $planets = Planet::where('last_update', '>=', (time() - 15 * 60))->get();

        return view('admin.planet.active', [
            'planets' => $planets,
            'title' => trans('admin/planet.active.title'),
        ]);
    }
}

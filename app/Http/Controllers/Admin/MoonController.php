<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planet;

class MoonController extends Controller
{
    public function index()
    {
        $mmons = Planet::where('planet_type', 3)->get();

        return view('admin.moon.index', [
            'moons' => $mmons,
            'title' => trans('admin/moon.index.title'),
        ]);
    }
}

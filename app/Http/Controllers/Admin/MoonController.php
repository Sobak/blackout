<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planet;
use App\Services\PlanetService;
use Illuminate\Http\Request;

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

    public function create()
    {
        return view('admin.moon.create', [
            'title' => trans('admin/moon.create.title'),
        ]);
    }

    public function createPost(Request $request)
    {
        $planet = Planet::find($request->get('user'));

        (new PlanetService())->createMoon(
            $planet->galaxy,
            $planet->system,
            $planet->planet,
            $planet->id_owner,
            time(),
            $request->get('name'),
            20
        );

        return show_message(trans('admin/moon.create.success_text'), trans('admin/moon.create.success_title'));
    }
}

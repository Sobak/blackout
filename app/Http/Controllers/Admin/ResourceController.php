<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planet;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function add()
    {
        return view('admin.resource.resource', [
            'action' => 'add',
            'title' => trans('admin/resources.add.title'),
        ]);
    }

    public function addPost(Request $request)
    {
        $planet = Planet::find($request->get('planet_id'));

        if ($planet) {
            $planet->metal = $planet->metal + $request->get('metal');
            $planet->crystal = $planet->crystal + $request->get('crystal');
            $planet->deuterium = $planet->deuterium + $request->get('deuterium');
            $planet->save();
        }

        return show_message(trans('admin/resources.add.success'), trans('app.success'));
    }

    public function subtract()
    {
        return view('admin.resource.resource', [
            'action' => 'subtract',
            'title' => trans('admin/resources.subtract.title'),
        ]);
    }

    public function subtractPost(Request $request)
    {
        $planet = Planet::find($request->get('planet_id'));

        if ($planet) {
            $planet->metal = $planet->metal - $request->get('metal');
            $planet->crystal = $planet->crystal - $request->get('crystal');
            $planet->deuterium = $planet->deuterium - $request->get('deuterium');
            $planet->save();
        }

        return show_message(trans('admin/resources.subtract.success'), trans('app.success'));
    }
}

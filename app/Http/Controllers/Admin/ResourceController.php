<?php

namespace App\Http\Controllers\Admin;

use App\Models\Planet;
use App\Models\User;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function add()
    {
        $this->restrictAccess(User::LEVEL_SUPER_OPERATOR);

        return view('admin.resource', [
            'action' => 'add',
            'title' => trans('admin/resources.add.title'),
        ]);
    }

    public function addPost(Request $request)
    {
        $this->restrictAccess(User::LEVEL_SUPER_OPERATOR);

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
        $this->restrictAccess(User::LEVEL_SUPER_OPERATOR);

        return view('admin.resource', [
            'action' => 'subtract',
            'title' => trans('admin/resources.subtract.title'),
        ]);
    }

    public function subtractPost(Request $request)
    {
        $this->restrictAccess(User::LEVEL_SUPER_OPERATOR);

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

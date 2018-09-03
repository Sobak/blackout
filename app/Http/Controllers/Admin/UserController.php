<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->has('sort')) {
            $users->orderBy($request->get('sort'), 'asc');
        }

        $users = $users->get();

        foreach ($users as $user) {
            $user->banned = $user->bana ? '<a href="#" title="' . gmdate('d/m/Y G:i:s', $user->banaday) . '">' . trans('admin/user.index.yes') . '</a>' : trans('admin/user.index.no');
            $user->ip_color = (isset($previousIP) && $previousIP == $user->user_lastip) ? 'red' : 'lime';

            $previousIP = $user->user_lastip;
        }

        return view('admin.user.index', [
            'title' => trans('admin/overview.index.title'),
            'users' => $users,
        ]);
    }

    public function remove($id)
    {
        (new UserService())->removeUser(User::find($id));

        return redirect()->route('admin.users');
    }
}

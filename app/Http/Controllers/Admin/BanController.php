<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ban;
use App\Models\User;
use Illuminate\Http\Request;

class BanController extends Controller
{
    public function add()
    {
        return view('admin.ban_add', [
            'title' => trans('admin/ban.add.title'),
        ]);
    }

    public function addPost(Request $request)
    {
        $user = User::where('username', $request->get('name'))->first();

        if ($user) {
            $banTime = $request->get('days') * 86400;
            $banTime += $request->get('hour') * 3600;
            $banTime += $request->get('mins') * 60;
            $banTime += $request->get('secs');

            $banUntil = time() + $banTime;

            $ban = new Ban();
            $ban->id = 0;
            $ban->who = $user->username;
            $ban->theme = $request->get('why');
            $ban->who2 = $request->get('name');
            $ban->longer = $banUntil;
            $ban->author = auth()->user()->username;
            $ban->email = str_limit(auth()->user()->email, 20, '');
            $ban->save();

            $user->bana = true;
            $user->banaday = $banUntil;
            $user->save();
        }

        $message = sprintf(trans('admin/ban.add.success'), $request->get('name'));

        return show_message($message, trans('admin/ban.add.title'));
    }

    public function remove()
    {
        return view('admin.ban_remove', [
            'title' => trans('admin/ban.remove.title'),
        ]);
    }

    public function removePost(Request $request)
    {
        $user = User::where('username', $request->get('nam'))->first();

        if ($user) {
            $user->bana = false;
            $user->banaday = 0;
            $user->save();
        }

        Ban::where('who2', $request->get('nam'))->first()->delete();

        $message = sprintf(trans('admin/ban.remove.success'), $request->get('nam'));

        return show_message($message, trans('admin/ban.remove.title'));
    }
}

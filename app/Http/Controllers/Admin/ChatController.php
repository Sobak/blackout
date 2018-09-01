<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        return view('admin.chat.index', [
            'messages' => Chat::get(),
            'title' => trans('admin/chat.title'),
        ]);
    }

    public function clear()
    {
        Chat::truncate();

        return redirect()->route('admin.chat');
    }

    public function remove($id)
    {
        Chat::find($id)->delete();

        return redirect()->route('admin.chat');
    }
}

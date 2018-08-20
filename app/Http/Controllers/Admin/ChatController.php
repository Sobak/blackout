<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $this->restrictAccess(User::LEVEL_ADMIN);

        return view('admin.chat', [
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

<?php

namespace App\Http\Controllers;

use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        $admins = User::where('authlevel', '!=', 0)->orderBy('authlevel', 'desc')->get();

        return view('contact.index', [
            'admins' => $admins,
            'title' => trans('chat.title'),
        ]);
    }
}

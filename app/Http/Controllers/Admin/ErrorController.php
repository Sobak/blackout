<?php

namespace App\Http\Controllers\Admin;

use App\Models\Error;
use App\Models\User;

class ErrorController extends Controller
{
    public function index()
    {
        $this->restrictAccess(User::LEVEL_ADMIN);

        return view('admin.errors', [
            'errors' => Error::get(),
            'title' => trans('admin/errors.title'),
        ]);
    }

    public function clear()
    {
        Error::truncate();

        return redirect()->route('admin.errors');
    }

    public function remove($id)
    {
        Error::find($id)->delete();

        return redirect()->route('admin.errors');
    }
}

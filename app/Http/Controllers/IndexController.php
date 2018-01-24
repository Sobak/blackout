<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->to('overview.php');
        }

        return redirect()->route('user.login');
    }
}

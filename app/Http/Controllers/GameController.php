<?php

namespace App\Http\Controllers;

use App\Http\Composers\AdminComposer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class GameController extends Controller
{
    public function __construct()
    {
        View::composer('admin.*', AdminComposer::class);
    }

    protected function restrictAccess($minimalLevel)
    {
        if (Auth::user()->authlevel < $minimalLevel) {
            return show_message(trans('admin/common.no-access'));
        }
    }
}

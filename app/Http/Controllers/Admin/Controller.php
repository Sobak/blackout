<?php

namespace App\Http\Controllers\Admin;

use App\Http\Composers\AdminComposer;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
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

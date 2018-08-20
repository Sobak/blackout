<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    protected function restrictAccess($minimalLevel)
    {
        if (Auth::user()->authlevel < $minimalLevel) {
            return show_message(trans('admin/common.no-access'));
        }
    }
}

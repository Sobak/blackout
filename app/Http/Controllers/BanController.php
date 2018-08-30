<?php

namespace App\Http\Controllers;

use App\Models\Ban;

class BanController extends Controller
{
    public function index()
    {
        $banned = Ban::all();

        if ($banned->count()) {
            $count = trans('ban.thereare') . ' ' . $ban->count() . ' ' . trans('ban.players');
        } else {
            $count = trans('ban.no_bans');
        }

        return view('ban.index', [
            'banned' => $banned,
            'count' => $count,
            'title' => trans('ban.title'),
        ]);
    }
}

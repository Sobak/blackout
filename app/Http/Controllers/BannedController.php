<?php

namespace App\Http\Controllers;

use App\Models\Banned;

class BannedController extends Controller
{
    public function index()
    {
        $banned = Banned::all();

        if ($banned->count()) {
            $count = trans('banned.thereare') . ' ' . $banned->count() . ' ' . trans('banned.players');
        } else {
            $count = trans('banned.no_bans');
        }

        return view('banned.index', [
            'banned' => $banned,
            'count' => $count,
            'title' => trans('banned.title'),
        ]);
    }
}

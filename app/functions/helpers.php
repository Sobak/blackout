<?php

use App\Models\Config;

function game_config($key)
{
    static $config = null;

    if ($config === null) {
        $config = Config::all()->pluck('config_value', 'config_name');
    }

    return $config[$key];
}

// @todo revisit
// once view composer loading navigation etc will be ready this function should
// replace old message()
function show_message($text, $title = 'Error')
{
    return view('message', [
        'message' => $text,
        'title' => $title,
    ]);
}

function skin_asset($path, $secure = null)
{
    return asset("skins/xnova/$path", $secure); //@fixme
}

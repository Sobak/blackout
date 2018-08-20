<?php

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
    return asset("skins/blackout/$path", $secure); //@fixme
}

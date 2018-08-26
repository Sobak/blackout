<?php

/**
 * Print planet/player/moon coordinates in human readable form.
 *
 * @param mixed $row Any entity which can be read as array and
 *                   has valid set of keys.
 * @return string
 */
function coordinates($row)
{
    return sprintf('[%d:%d:%d]', $row['galaxy'], $row['system'], $row['planet']);
}

// @todo revisit
// once view composer loading navigation etc will be ready this function should
// replace old message()
function show_message($text, $title = 'Error', $redirectTo = null, $redirectTime = 3)
{
    return view('message', [
        'message' => $text,
        'title' => $title,
        'redirectTo' => $redirectTo,
        'redirectTime' => $redirectTime,
    ]);
}

function skin_asset($path, $secure = null)
{
    return asset("skins/blackout/$path", $secure); //@fixme
}

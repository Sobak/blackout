<?php

use Illuminate\Support\HtmlString;

/**
 * Print HTML for the checkbox field.
 *
 * @param string $name Input name
 * @param bool $checked Logical value determining if checkbox is checked
 * @return HtmlString
 */
function checkbox($name, $checked)
{
    $html = '<input name="' . $name . '" ';

    if ($checked) {
        $html .= 'checked ';
    }

    $html .= 'type="checkbox">';

    return new HtmlString($html);
}

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

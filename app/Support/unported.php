<?php

/**
 * Fetches all languages available.
 */
function getAvailableLanguages()
{
    $languages = [];

    foreach (glob(resource_path('lang/*/_info.php')) as $langInfoFile) {
        require $langInfoFile;

        $langKey = array_pop(explode('/', dirname($langInfoFile)));

        /** @noinspection PhpUndefinedVariableInspection */
        $languages[$langKey] = $langInfos['DISPLAY_NAME'];
    }

    return $languages;
}

/**
 * Fetches all skins available.
 */
function getAvailableSkins()
{
    $skins = [];

    foreach (glob(public_path('skins/*'), GLOB_ONLYDIR) as $skin) {
        $skins[] = array_pop(explode('/', $skin));
    }

    return $skins;
}

/**
 * Make text red.
 *
 * @param $n
 * @return string
 */
function colorRed($n) {
    return '<font color="#ff0000">' . $n . '</font>';
}

/**
 * Prettify the number.
 *
 * @param $n
 * @param bool $floor
 * @return string
 */
function pretty_number($n, $floor = true) {
    if ($floor) {
        $n = floor($n);
    }
    return number_format($n, 0, ",", ".");
}

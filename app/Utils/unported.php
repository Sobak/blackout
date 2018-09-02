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
 * Displays a start address as a link.
 *
 * @param $FleetRow
 * @param $FleetType
 * @return string
 */
function GetStartAdressLink ( $FleetRow, $FleetType ) {
    $Link  = "<a href=\"galaxy.php?mode=3&galaxy=".$FleetRow['fleet_start_galaxy']."&system=".$FleetRow['fleet_start_system']."\" ". $FleetType ." >";
    $Link .= "[".$FleetRow['fleet_start_galaxy'].":".$FleetRow['fleet_start_system'].":".$FleetRow['fleet_start_planet']."]</a>";
    return $Link;
}

/**
 * Displays a target address as a link.
 *
 * @param $FleetRow
 * @param $FleetType
 * @return string
 */
function GetTargetAdressLink ( $FleetRow, $FleetType ) {
    $Link  = "<a href=\"galaxy.php?mode=3&galaxy=".$FleetRow['fleet_end_galaxy']."&system=".$FleetRow['fleet_end_system']."\" ". $FleetType ." >";
    $Link .= "[".$FleetRow['fleet_end_galaxy'].":".$FleetRow['fleet_end_system'].":".$FleetRow['fleet_end_planet']."]</a>";
    return $Link;
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

/**
 * Print time in human readable format.
 *
 * @param $seconds
 * @return string
 */
function pretty_time ($seconds) {
    $day = floor($seconds / (24 * 3600));
    $hs = floor($seconds / 3600 % 24);
    $ms = floor($seconds / 60 % 60);
    $sr = floor($seconds / 1 % 60);

    if ($hs < 10) { $hh = "0" . $hs; } else { $hh = $hs; }
    if ($ms < 10) { $mm = "0" . $ms; } else { $mm = $ms; }
    if ($sr < 10) { $ss = "0" . $sr; } else { $ss = $sr; }

    $time = '';
    if ($day != 0) { $time .= $day . 'j '; }
    if ($hs  != 0) { $time .= $hh . 'h ';  } else { $time .= '00h '; }
    if ($ms  != 0) { $time .= $mm . 'm ';  } else { $time .= '00m '; }
    $time .= $ss . 's';

    return $time;
}

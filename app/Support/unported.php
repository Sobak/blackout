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

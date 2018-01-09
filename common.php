<?php

define('VERSION', '0.4.0-dev');

$game_config   = array();
$user          = array();
$lang          = array();
$IsUserChecked = false;

define('DEFAULT_SKINPATH' , 'skins/xnova/');
define('TEMPLATE_DIR'     , 'templates/');
define('TEMPLATE_NAME'    , 'default');
define('DEFAULT_LANG'     , 'en');

$HTTP_ACCEPT_LANGUAGE = DEFAULT_LANG;

include($ugamela_root_path . 'includes/debug.class.php');
$debug = new Debug();

include($ugamela_root_path . 'includes/constants.php');
include($ugamela_root_path . 'includes/functions.php');
include($ugamela_root_path . 'includes/unlocalised.php');
include($ugamela_root_path . 'includes/todofleetcontrol.php');
include($ugamela_root_path . 'language/'. DEFAULT_LANG .'/lang_info.cfg');

if (!defined('INSTALL') || INSTALL !== true) {
    include($ugamela_root_path . 'config.php');
    include($ugamela_root_path . 'includes/vars.php');
    include($ugamela_root_path . 'includes/db.php');
    include($ugamela_root_path . 'includes/strings.php');

    // Read the config table
    $query = doquery("SELECT * FROM {{table}}",'config');
    while ( $row = mysql_fetch_assoc($query) ) {
        $game_config[$row['config_name']] = $row['config_value'];
    }

    if ($InLogin != true) {
        $Result        = CheckTheUser($IsUserChecked);
        $IsUserChecked = $Result['state'];
        $user          = $Result['record'];
    } elseif ($InLogin == false) {
        // Are we in maintenance mode?
        if( $game_config['game_disable']) {
            if ($user['authlevel'] < 1) {
                message(stripslashes($game_config['close_reason']), $game_config['game_name']);
            }
        }
    }

    includeLang ("system");
    includeLang ('tech');
    includeLang ('leftmenu');

    if ( isset ($user) ) {
        $_fleets = doquery("SELECT * FROM {{table}} WHERE `fleet_start_time` <= '".time()."';", 'fleets'); //  OR fleet_end_time <= ".time()
        while ($row = mysql_fetch_array($_fleets)) {
            $array                = array();
            $array['galaxy']      = $row['fleet_start_galaxy'];
            $array['system']      = $row['fleet_start_system'];
            $array['planet']      = $row['fleet_start_planet'];
            $array['planet_type'] = $row['fleet_start_type'];

            FlyingFleetHandler ($array);
        }

        $_fleets = doquery("SELECT * FROM {{table}} WHERE `fleet_end_time` <= '".time()."';", 'fleets'); //  OR fleet_end_time <= ".time()
        while ($row = mysql_fetch_array($_fleets)) {
            $array                = array();
            $array['galaxy']      = $row['fleet_end_galaxy'];
            $array['system']      = $row['fleet_end_system'];
            $array['planet']      = $row['fleet_end_planet'];
            $array['planet_type'] = $row['fleet_end_type'];

            FlyingFleetHandler ($array);
        }

        unset($_fleets);

        include($ugamela_root_path . 'rak.php');
        if ( defined('IN_ADMIN') ) {
            $UserSkin  = $user['dpath'];
            $local     = stristr ( $UserSkin, "http:");
            if ($local === false) {
                if (!$user['dpath']) {
                    $dpath     = "../". DEFAULT_SKINPATH  ;
                } else {
                    $dpath     = "../". $user["dpath"];
                }
            } else {
                $dpath     = $UserSkin;
            }
        } else {
            $dpath     = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
        }

        SetSelectedPlanet ( $user );

        $planetrow = doquery("SELECT * FROM {{table}} WHERE `id` = '".$user['current_planet']."';", 'planets', true);
        $galaxyrow = doquery("SELECT * FROM {{table}} WHERE `id_planet` = '".$planetrow['id']."';", 'galaxy', true);

        CheckPlanetUsedFields($planetrow);

        $user['new_message'] = doquery("SELECT COUNT(*) AS `count` FROM {{table}} WHERE `message_unread` = 1 AND `message_owner` = '{$user['id']}'", 'messages', true)['count'];
    }
} else {
    $dpath     = "../" . DEFAULT_SKINPATH;
}

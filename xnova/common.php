<?php

$game_config   = array();
$user          = null;
$lang          = array();

define('DEFAULT_SKIN' , 'blackout');
define('TEMPLATE_DIR' , 'templates/');
define('TEMPLATE_NAME', 'default');
define('DEFAULT_LANG' , 'en');

$HTTP_ACCEPT_LANGUAGE = DEFAULT_LANG;

include($ugamela_root_path . 'includes/debug.class.php');
$debug = new Debug();

include($ugamela_root_path . 'includes/constants.php');
include($ugamela_root_path . 'includes/functions.php');
include($ugamela_root_path . 'includes/unlocalised.php');
include($ugamela_root_path . 'includes/todofleetcontrol.php');
include(resource_path('lang/' . DEFAULT_LANG . '/_info.php'));

if (file_exists(base_path('.env')) === false || filesize(base_path('.env')) == 0) {
    redirect_to('install/');
}

include($ugamela_root_path . 'includes/vars.php');
include($ugamela_root_path . 'includes/db.php');
include($ugamela_root_path . 'includes/strings.php');

// Read the config table
$query = doquery("SELECT * FROM {{table}}",'config');
while ( $row = mysql_fetch_assoc($query) ) {
    $game_config[$row['config_name']] = $row['config_value'];
}

includeLang ("system");
includeLang ('tech');
includeLang ('leftmenu');

if (Auth::check()) {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $user->onlinetime = time();
    $user->user_lastip = $_SERVER['REMOTE_ADDR'];
    $user->user_agent = $_SERVER['HTTP_USER_AGENT'];
    $user->save();

    $user = $user->toArray();

    $dpath = (!$user["dpath"]) ? DEFAULT_SKIN : $user["dpath"];
    $dpath = "skins/$dpath/";

    if ($game_config['game_disable'] && $user['authlevel'] < LEVEL_OPERATOR) {
        message($game_config['close_reason'], $game_config['game_name']);
    }

    if ($user['bana'] == "1") {
        die (
        'Vous avez &eacute;t&eacute; bannis. Plus D\'infos <a href="banned.php">ici</a>.'
        );
    }

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

    SetSelectedPlanet ( $user );

    $planetrow = doquery("SELECT * FROM {{table}} WHERE `id` = '".$user['current_planet']."';", 'planets', true);
    $galaxyrow = doquery("SELECT * FROM {{table}} WHERE `id_planet` = '".$planetrow['id']."';", 'galaxy', true);

    CheckPlanetUsedFields($planetrow);

    $user['new_message'] = doquery("SELECT COUNT(*) AS `count` FROM {{table}} WHERE `message_unread` = 1 AND `message_owner` = '{$user['id']}'", 'messages', true)['count'];
}

// fixme? this will be null for unauthenticated users
addTemplateGlobal('dpath', $dpath);

<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_SUPER_OPERATOR);

includeLang('admin/addmoon');

$mode      = $_POST['mode'];

$PageTpl   = gettemplate("admin/add_moon");
$parse     = $lang;

if ($mode == 'addit') {
    $PlanetID  = $_POST['user'];
    $MoonName  = $_POST['name'];

    $QrySelectPlanet  = "SELECT * FROM {{table}} ";
    $QrySelectPlanet .= "WHERE ";
    $QrySelectPlanet .= "`id` = '". $PlanetID ."';";
    $PlanetSelected = doquery ( $QrySelectPlanet, 'planets', true);

    $Galaxy    = $PlanetSelected['galaxy'];
    $System    = $PlanetSelected['system'];
    $Planet    = $PlanetSelected['planet'];
    $Owner     = $PlanetSelected['id_owner'];
    $MoonID    = time();

    CreateOneMoonRecord ( $Galaxy, $System, $Planet, $Owner, $MoonID, $MoonName, 20 );

    message($lang['addm_done'], $lang['addm_title'], null, 0, false);
}
$Page = parsetemplate($PageTpl, $parse);

display($Page, $lang['addm_title'], false);

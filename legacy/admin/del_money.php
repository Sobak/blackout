<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_SUPER_OPERATOR);

includeLang('admin');

$mode      = $_POST['mode'];

$PageTpl   = gettemplate("admin/del_money");
$parse     = $lang;

if ($mode == 'addit') {
    $id          = $_POST['id'];
    $metal       = $_POST['metal'];
    $cristal     = $_POST['cristal'];
    $deut        = $_POST['deut'];

    $QryUpdatePlanet  = "UPDATE {{table}} SET ";
    $QryUpdatePlanet .= "`metal` = `metal` - '". $metal ."', ";
    $QryUpdatePlanet .= "`crystal` = `crystal` - '". $cristal ."', ";
    $QryUpdatePlanet .= "`deuterium` = `deuterium` - '". $deut ."' ";
    $QryUpdatePlanet .= "WHERE ";
    $QryUpdatePlanet .= "`id` = '". $id ."' ";
    doquery( $QryUpdatePlanet, "planets");

    message($lang['adm_dm_done'], $lang['adm_dm_ttle'], null, 0, false);
}
$Page = parsetemplate($PageTpl, $parse);

display($Page, $lang['adm_dm_ttle'], false);

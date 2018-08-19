<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = '../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_OPERATOR);

includeLang('admin');

if ($_GET['cmd'] == 'sort') {
    $TypeSort = $_GET['type'];
} else {
    $TypeSort = "id";
}

$PageTPL  = gettemplate('admin/overview_body');
$RowsTPL  = gettemplate('admin/overview_rows');

$parse                      = $lang;
$parse['adm_ov_data_yourv'] = colorRed(\App\Services\Blackout::VERSION);

$Last15Mins = doquery("SELECT * FROM {{table}} WHERE `onlinetime` >= '". (time() - 15 * 60) ."' ORDER BY `". $TypeSort ."` ASC;", 'users');
$Count      = 0;
$Color      = "lime";
while ( $TheUser = mysql_fetch_array($Last15Mins) ) {
    if ($PrevIP != "") {
        if ($PrevIP == $TheUser['user_lastip']) {
            $Color = "red";
        } else {
            $Color = "lime";
        }
    }

    $UserPoints = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $TheUser['id'] . "';", 'statpoints', true);

    $Bloc['adm_ov_altpm']        = $lang['adm_ov_altpm'];
    $Bloc['adm_ov_wrtpm']        = $lang['adm_ov_wrtpm'];
    $Bloc['adm_ov_data_id']      = $TheUser['id'];
    $Bloc['adm_ov_data_name']    = $TheUser['username'];
    $Bloc['adm_ov_data_agen']    = $TheUser['user_agent'];
    $Bloc['adm_ov_data_clip']    = $Color;
    $Bloc['adm_ov_data_adip']    = $TheUser['user_lastip'];
    $Bloc['adm_ov_data_ally']    = $TheUser['ally_name'];
    $Bloc['adm_ov_data_point']   = pretty_number ( $UserPoints['total_points'] );
    $Bloc['adm_ov_data_activ']   = pretty_time ( time() - $TheUser['onlinetime'] );
    $Bloc['adm_ov_data_pict']    = "m.gif";
    $PrevIP                      = $TheUser['user_lastip'];

    $parse['adm_ov_data_table'] .= parsetemplate( $RowsTPL, $Bloc );
    $Count++;
}

$parse['adm_ov_data_count']  = $Count;
$page = parsetemplate($PageTPL, $parse);

display($page, $lang['adm_ov_title'], false);

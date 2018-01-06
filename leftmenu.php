<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('leftmenu');

$parse                    = $lang;
$parse['lm_tx_serv']      = $game_config['resource_multiplier'];
$parse['lm_tx_game']      = $game_config['game_speed'] / 2500;
$parse['lm_tx_fleet']     = $game_config['fleet_speed'] / 2500;
$parse['lm_tx_queue']     = MAX_FLEET_OR_DEFS_PER_ROW;
$parse['server_info']     = parsetemplate(gettemplate('serv_infos'), $parse);
$parse['XNovaRelease']    = VERSION;
$parse['dpath']           = $dpath;
$parse['forum_url']       = $game_config['forum_url'];
$parse['mf']              = "Hauptframe";
$rank                     = doquery("SELECT `total_rank` FROM {{table}} WHERE `stat_code` = '1' AND `stat_type` = '1' AND `id_owner` = '". $user['id'] ."';",'statpoints',true);
$parse['user_rank']       = $rank['total_rank'];
if ($user['authlevel'] > 0) {
    $parse['ADMIN_LINK']  = '
    <tr>
        <td colspan="2"><a href="admin/leftmenu.php" style="color:lime">'.$lang['user_level'][$user['authlevel']].'</a></td>
    </tr>';
} else {
    $parse['ADMIN_LINK']  = '';
}
$parse['servername']   = $game_config['game_name'];
$Menu                  = parsetemplate(gettemplate('left_menu'), $parse);

display ( $Menu, "Menu", '', false );

<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'common.php');

includeLang('leftmenu');

if ($user['authlevel'] < 1) {
    message($lang['sys_noalloaw'], $lang['sys_noaccess']);
}

$parse                 = $lang;
$parse['mf']           = "Hauptframe";
$parse['dpath']        = $dpath;
$parse['XNovaRelease'] = VERSION;
$parse['servername']   = 'XNova';

if ($user['authlevel'] == 1) {
    $template = 'admin/left_menu_modo';
} elseif ($user['authlevel'] == 2) {
    $template = 'admin/left_menu_op';
} elseif ($user['authlevel'] >= 3) {
    $template = 'admin/left_menu';
}

$page = parsetemplate(gettemplate($template), $parse);
display($page, '', false, '', true);

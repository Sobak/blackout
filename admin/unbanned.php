<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_SUPER_OPERATOR);

$parse['dpath'] = $dpath;
$parse = $lang;

$mode = $_GET['mode'];

if ($mode != 'change') {
    $parse['Name'] = "Nom du joueur";
} elseif ($mode == 'change') {
    $nam = $_POST['nam'];
    doquery("DELETE FROM {{table}} WHERE who2='{$nam}'", 'banned');
    doquery("UPDATE {{table}} SET bana=0, banaday=0 WHERE username='{$nam}'", "users");
    message("Le joueur {$nam} a bien &eacute;t&eacute; d&eacute;banni!", 'Information');
}

display(parsetemplate(gettemplate('admin/unbanned'), $parse), "Overview", false);

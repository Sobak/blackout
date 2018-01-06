<?php

// Mais qu'est ce qu'il voullait demontrer lui ????

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = '../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_ADMIN);

$lang['PHP_SELF'] = 'options.php';
doquery("UPDATE {{table}} SET `banaday` =` banaday` - '1' WHERE `banaday` != '0';",'users');
doquery("UPDATE {{table}} SET `bana` = '0' WHERE `banaday` < '1';",'users');
$parse = $game_config;
$parse['dpath'] = $dpath;
$parse['debug'] = ($game_config['debug'] == 1) ? " checked='checked'/":'';

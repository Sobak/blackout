<?php

/**
 * lostpassword.php
 *
 * @version 1.0
 * @copyright 2008 by Tom1991 for XNova
 */

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('lostpassword');

if ($action != 1) {
    $parse               = $lang;
    $parse['servername'] = $game_config['game_name'];
    $page .= parsetemplate(gettemplate('lostpassword'), $parse);
    display($page, $lang['system'], false);
}
if ($action == 1) {
    $email               = $_POST['email'];
    sendnewpassword($email);
    message('Le nouveau mot de passe a &eacute;t&eacute; envoy&eacute; avec succ&egrave;s !', 'OK');
}

// History version
// 1.0 Création (Tom)
?>
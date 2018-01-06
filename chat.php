<?php

/**
 * chat.php
 *
 * @version 1.0
 * @copyright 2008 by e-Zobar for XNova
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$ugamela_root_path = './';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path . 'common.' . $phpEx);

	includeLang('chat');

	$nick = $user['username'];
	$parse = $lang;

	display(parsetemplate(gettemplate('chat_body'), $parse), $lang['Chat']);
// Shoutbox by e-Zobar - Copyright XNova Team 2008
?>
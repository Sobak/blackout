<?php

/**
 * logout.php
 *
 * @version 1.0
 * @copyright 2008 by ?????? for XNova
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

	includeLang('logout');

	setcookie($game_config['COOKIE_NAME'], "", time()-100000, "/", "", 0);

	message ( $lang['see_you'], $lang['session_closed'], "login.php" );

// -----------------------------------------------------------------------------------------------------------
// History version
?>
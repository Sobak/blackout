<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('logout');

setcookie($game_config['COOKIE_NAME'], "", time()-100000, "/", "", 0);

message($lang['see_you'], $lang['session_closed'], "login.php", 2);

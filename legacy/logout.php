<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('logout');

Auth::logout();
Session::save();

message($lang['see_you'], $lang['session_closed'], "login", 2);

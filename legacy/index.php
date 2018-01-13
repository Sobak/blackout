<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

if (isset($user)) {
    redirect_to('overview.php');
}

redirect_to('login.php');

<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

if (file_exists('config.php') === false || filesize('config.php') == 0) {
    header('location: install/');
    exit();
}

if (isset($user)) {
    redirect('overview.php');
}

redirect('login.php');

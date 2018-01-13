<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

if (isset($user)) {
    redirect('overview.php');
}

redirect('login.php');

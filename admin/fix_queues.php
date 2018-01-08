<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
require $ugamela_root_path . 'common.php';
require $ugamela_root_path . 'includes/functions/ElementQueueFixer.php';

includeLang('admin');

$deletedQueues = ElementQueueFixer();

if ($deletedQueues > 0) {
    $message = $lang['adm_cleaned']." ". $deletedQueues;
} else {
    $message = $lang['adm_done'];
}

message($message, $lang['adm_cleaner_title'], null, 0, false);

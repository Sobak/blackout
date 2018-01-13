<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

if (in_array($_GET['lang'], array_keys(getAvailableLanguages()))) {
    setcookie('xnova_language', $_GET['lang'], time() + 60 * 60 * 24 * 30);
}

header('Location: index.php');

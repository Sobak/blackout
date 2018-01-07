<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

$expiretime = time()+31536000;
$Nazwa = "Langs";

if (in_array($_GET['lang'], array_keys(getAvailableLanguages()))) {
    setcookie($Nazwa, $_GET['lang'], $expiretime, "/", "", 0);
}

header('Location: index.php');

<?php

/**
 * stat.php
 *
 * @version 1.0
 * @copyright 2008 by e-Zobar for XNova
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('credit');

$parse   = $lang;

display(parsetemplate(gettemplate('credit_body'), $parse), $lang['cred_credit'], false);
?>
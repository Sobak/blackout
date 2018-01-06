<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_OPERATOR);

includeLang('admin/md5enc');

$parse   = $lang;

if ($_POST['md5q'] != "") {
    $parse['md5_md5'] = $_POST['md5q'];
    $parse['md5_enc'] = md5 ($_POST['md5q']);
} else {
    $parse['md5_md5'] = "";
    $parse['md5_enc'] = md5 ("");
}

$PageTpl = gettemplate("admin/md5enc");
$Page    = parsetemplate( $PageTpl, $parse);

display( $Page, $lang['md5_title'], false, '', true );

<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = '../';
include($ugamela_root_path . 'common.php');

includeLang('changelog');
$template = gettemplate('changelog_table');

$parse = $lang;

foreach($lang['changelog'] as $a => $b)
{

    $parse['version_number'] = $a;
    $parse['description']    = nl2br($b);

    $body .= parsetemplate($template, $parse);

}

$parse['body'] = $body;

$page .= parsetemplate(gettemplate('changelog_body'), $parse);
display( $page, "Changelog", false, '', true);

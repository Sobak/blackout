<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = '../';
include($ugamela_root_path . 'common.php');

includeLang('admin/errors');
$parse = $lang;

restrictAccess($user, LEVEL_ADMIN);

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    doquery('DELETE FROM {{table}} WHERE `error_id`=' . $_GET['delete'], 'errors');
} elseif (isset($_GET['deleteall']) && $_GET['deleteall'] == 'yes') {
    doquery("TRUNCATE TABLE {{table}}", 'errors');
}

$errors = doquery('SELECT * FROM {{table}}', 'errors');
$errors_count = mysql_num_rows($errors);

$row_template = gettemplate('admin/errors_row');

while ($error = mysql_fetch_array($errors)) {
    $error['error_time'] = date('d/m/Y h:i:s', $e['error_time']);
    $error['error_text'] = nl2br($error['error_text']);

    $parse['errors_list'] .= parsetemplate($row_template, $error);
}

$parse['errors_count'] = $errors_count;

display(parsetemplate(gettemplate('admin/errors_body'), $parse), $lang['adm_er_ttle'], false);

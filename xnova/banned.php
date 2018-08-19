<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
require 'common.php';

includeLang('banned');

$parse = $lang;

$bans = doquery('SELECT * FROM {{table}} ORDER BY `id`', 'banned')->fetchAll();
$bans_count = count($bans);

$row_template = gettemplate('banned_row');
foreach ($bans as $ban) {
    $ban['name'] = $ban[1];
    $ban['reason'] = $ban[2];
    $ban['from'] = gmdate('d/m/Y G:i:s', $ban[4]);
    $ban['to'] = gmdate('d/m/Y G:i:s', $ban[5]);
    $ban['by'] = $ban[6];

    $parse['banned_rows'] .= parsetemplate($row_template, $ban);
}

if ($bans_count) {
    $parse['bans_count'] = $lang['ban_thereare'] . ' ' . $bans_count . ' ' . $lang['ban_players'];
} else {
    $parse['bans_count'] = $lang['ban_no_bans'];
}

display(parsetemplate(gettemplate('banned_body'), $parse), 'Banned');

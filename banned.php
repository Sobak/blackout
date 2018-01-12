<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
require 'common.php';

includeLang('banned');

$parse = $lang;

$bans = doquery('SELECT * FROM {{table}} ORDER BY `id`', 'banned');
$bans_count = mysql_num_rows($bans);

$row_template = gettemplate('banned_row');
while ($ban = mysql_fetch_row($bans)) {
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

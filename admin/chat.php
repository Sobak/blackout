<?php

define('INSIDE'  , true);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'common.php');

restrictAccess($user, LEVEL_ADMIN);

includeLang('admin');
$parse = $lang;

// Removing messages
$delete = $_GET['delete'];
$deleteAll = $_GET['deleteall'];

if (isset($delete)) {
    doquery("DELETE FROM {{table}} WHERE `messageid`=$delete", 'chat');
} elseif ($deleteAll == 'yes') {
    doquery("DELETE FROM {{table}}", 'chat');
}

// Get messages
$query = doquery("SELECT c.message, c.timestamp, u.username FROM {{table}}chat c JOIN {{table}}users u ON c.user_id = u.id ORDER BY c.id DESC LIMIT 25", '');
while ($e = mysql_fetch_array($query)) {
    $parse['msg_list'] .= stripslashes("<tr><td class=n rowspan=2>{$e['id']}</td>" .
    "<td class=n><center>[<a href=?delete={$e['id']}>X</a>]</center></td>" .
    "<td class=n><center>{$e['username']}</center></td>" .
    "<td class=n><center>" . date('d.m.Y H:i:s', $e['timestamp']) . "</center></td></tr><tr>" .
    "<td class=b colspan=4 width=500>" . nl2br($e['message']) . "</td></tr>");
}

$count = mysql_num_rows($query);
$parse['msg_list'] .= "<tr><th class=b colspan=4>{$count} ".$lang['adm_ch_nbs']."</th></tr>";

display(parsetemplate(gettemplate('admin/chat_body'), $parse), "Chat", false);

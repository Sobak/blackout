<?php

define('INSIDE', true);

$ugamela_root_path = './';
require 'common.php';
require 'includes/functions/ParseBBCode.php';

includeLang('chat');

$mode = $_GET['mode'];
switch ($mode) {
    case 'add_message':
        if (isset($_POST["msg"]) && isset($user['id'])) {
            $msg = trim(str_replace("+","plus", $_POST["msg"]));
            $msg = mysql_real_escape_string($_POST["msg"]);
            $user_id = $user['id'];
        } else {
            $msg = $user_id = '';
        }

        if ($msg != '' && $user_id != '') {
            $query = doquery("INSERT INTO {{table}} SET user_id = '$user_id', message = '$msg', timestamp = UNIX_TIMESTAMP();", "chat");
        }
        break;

    case 'messages':
        $query = doquery("SELECT c.message, u.username FROM {{table}}chat c JOIN {{table}}users u ON c.user_id = u.id ORDER BY c.id", '');

        while ($row = mysql_fetch_array($query)) {
            $nick = htmlentities(utf8_decode($row['username']));
            $message = ParseBBCode(htmlentities(utf8_decode($row['message'])));

            echo "<div align='left'>$nick > $message<br></div>";
        }
        break;

    default:
        $parse = $lang;

        display(parsetemplate(gettemplate('chat_body'), $parse), $lang['Chat']);
}

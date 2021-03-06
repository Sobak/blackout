<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('messages');

$OwnerID       = $_GET['id'];
$MessCategory  = $_GET['messcat'];
$MessPageMode  = $_GET["mode"];
$DeleteWhat    = $_POST['deletemessages'];
if (isset ($DeleteWhat)) {
    $MessPageMode = "delete";
}

$UsrMess       = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' ORDER BY `message_time` DESC;", 'messages');
$UnReadResult  = doquery("SELECT COUNT(*) AS `count`, `message_type` AS `type` FROM {{table}} WHERE `message_owner` = {$user['id']} AND `message_unread` = 1 GROUP BY `message_type`", 'messages');

$UnRead = [];
$UnReadTotal = 0;
while ($row = mysql_fetch_array($UnReadResult)) {
    $UnRead[$row['type']] = $row['count'];
    $UnReadTotal += $row['count'];
}

$MessageType   = array ( 0, 1, 2, 3, 4, 5, 15, 99, 100 );
$TitleColor    = array ( 0 => '#FFFF00', 1 => '#FF6699', 2 => '#FF3300', 3 => '#FF9900', 4 => '#773399', 5 => '#009933', 15 => '#030070', 99 => '#007070', 100 => '#ABABAB'  );
$BackGndColor  = array ( 0 => '#663366', 1 => '#336666', 2 => '#000099', 3 => '#666666', 4 => '#999999', 5 => '#999999', 15 => '#999999', 99 => '#999999', 100 => '#999999'  );

foreach ($MessageType as $MessType) {
    $WaitingMess[$MessType] = isset($UnRead[$MessType]) ? $UnRead[$MessType] : 0;
    $TotalMess[$MessType] = 0;
}

$WaitingMess[100] = $UnReadTotal;

while ($CurMess = mysql_fetch_array($UsrMess)) {
    $MessType              = $CurMess['message_type'];
    $TotalMess[$MessType] += 1;
    $TotalMess[100]       += 1;
}

switch ($MessPageMode) {
    case 'write':
        // -------------------------------------------------------------------------------------------------------
        // Envoi d'un messages
        if ( !is_numeric( $OwnerID ) ) {
            message ($lang['mess_no_ownerid'], $lang['sys_error']);
        }

        $OwnerRecord = doquery("SELECT * FROM {{table}} WHERE `id` = '".$OwnerID."';", 'users', true);

        if (!$OwnerRecord) {
            message ($lang['mess_no_owner']  , $lang['sys_error']);
        }

        $OwnerHome   = doquery("SELECT * FROM {{table}} WHERE `id_planet` = '". $OwnerRecord["id_planet"] ."';", 'galaxy', true);
        if (!$OwnerHome) {
            message ($lang['mess_no_ownerpl'], $lang['sys_error']);
        }

        if ($_POST) {
            $error = 0;
            if (!$_POST["subject"]) {
                $error++;
                $page .= "<center><br><font color=#FF0000>".$lang['mess_no_subject']."<br></font></center>";
            }
            if (!$_POST["text"]) {
                $error++;
                $page .= "<center><br><font color=#FF0000>".$lang['mess_no_text']."<br></font></center>";
            }
            if ($error == 0) {
                $page .= message_simple($lang['mess_sended'], $lang['sys_success']);

                $_POST['text'] = str_replace("'", '&#39;', $_POST['text']);

                $Owner   = $OwnerID;
                $Sender  = $user['id'];
                $From    = $user['username'] ." [".$user['galaxy'].":".$user['system'].":".$user['planet']."]";
                $Subject = $_POST['subject'];
                $Message = trim ( nl2br ( strip_tags ( $_POST['text'], '<br>' ) ) );
                SendSimpleMessage ( $Owner, $Sender, '', 1, $From, $Subject, $Message);
                $subject = "";
                $text    = "";
            }
        }
        $parse['Send_message'] = $lang['mess_pagetitle'];
        $parse['Recipient']    = $lang['mess_recipient'];
        $parse['Subject']      = $lang['mess_subject'];
        $parse['Message']      = $lang['mess_message'];
        $parse['characters']   = $lang['mess_characters'];
        $parse['Envoyer']      = $lang['mess_envoyer'];

        $parse['id']           = $OwnerID;
        $parse['to']           = $OwnerRecord['username'] ." [".$OwnerHome['galaxy'].":".$OwnerHome['system'].":".$OwnerHome['planet']."]";
        $parse['subject']      = (!isset($subject)) ? $lang['mess_no_subject'] : $subject ;
        $parse['text']         = $text;

        $page                 .= parsetemplate(gettemplate('messages_pm_form'), $parse);
        break;

    case 'delete':
        // -------------------------------------------------------------------------------------------------------
        // Suppression des messages selectionnés
        $DeleteWhat = $_POST['deletemessages'];
        if       ($DeleteWhat == 'deleteall') {
            doquery("DELETE FROM {{table}} WHERE `message_owner` = '". $user['id'] ."';", 'messages');
        } elseif ($DeleteWhat == 'deletemarked') {
            foreach($_POST as $Message => $Answer) {
                if (preg_match("/delmes/i", $Message) && $Answer == 'on') {
                    $MessId   = str_replace("delmes", "", $Message);
                    $MessHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MessId ."' AND `message_owner` = '". $user['id'] ."';", 'messages');
                    if ($MessHere) {
                        doquery("DELETE FROM {{table}} WHERE `message_id` = '".$MessId."';", 'messages');
                    }
                }
            }
        } elseif ($DeleteWhat == 'deleteunmarked') {
            foreach($_POST as $Message => $Answer) {
                $CurMess    = preg_match("/showmes/i", $Message);
                $MessId     = str_replace("showmes", "", $Message);
                $Selected   = "delmes".$MessId;
                $IsSelected = $_POST[ $Selected ];
                if (preg_match("/showmes/i", $Message) && !isset($IsSelected)) {
                    $MessHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MessId ."' AND `message_owner` = '". $user['id'] ."';", 'messages');
                    if ($MessHere) {
                        doquery("DELETE FROM {{table}} WHERE `message_id` = '".$MessId."';", 'messages');
                    }
                }
            }
        }
        $MessCategory = $_POST['category'];

    case 'show':
        // -------------------------------------------------------------------------------------------------------
        // Affichage de la page des messages
        $page = "<center>";
        $page .= "<table>";
        $page .= "<tr>";
        $page .= "<td></td>";
        $page .= "<td>\n";
        $page .= "<table width=\"519\">";
        $page .= "<form action=\"messages.php\" method=\"post\"><table>";
        $page .= "<tr>";
        $page .= "<td></td>";
        $page .= "<td>\n<input name=\"messages\" value=\"1\" type=\"hidden\">";
        $page .= "<table width=\"519\">";
        $page .= "<tr>";
        $page .= "<th colspan=\"4\">";
        $page .= "<select onchange=\"document.getElementById('deletemessages').options[this.selectedIndex].selected='true'\" id=\"deletemessages2\" name=\"deletemessages2\">";
        $page .= "<option value=\"deletemarked\">".$lang['mess_deletemarked']."</option>";
        $page .= "<option value=\"deleteunmarked\">".$lang['mess_deleteunmarked']."</option>";
        $page .= "<option value=\"deleteall\">".$lang['mess_deleteall']."</option>";
        $page .= "</select>";
        $page .= "<input value=\"".$lang['mess_its_ok']."\" type=\"submit\">";
        $page .= "</th>";
        $page .= "</tr><tr>";
        $page .= "<th style=\"color: rgb(242, 204, 74);\" colspan=\"4\">";
        $page .= "<input name=\"category\" value=\"".$MessCategory."\" type=\"hidden\">";
        $page .= "<input onchange=\"document.getElementById('fullreports').checked=this.checked\" id=\"fullreports2\" name=\"fullreports2\" type=\"checkbox\">".$lang['mess_partialreport']."</th>";
        $page .= "</tr><tr>";
        $page .= "<th>".$lang['mess_action']."</th>";
        $page .= "<th>".$lang['mess_date']."</th>";
        $page .= "<th>".$lang['mess_from']."</th>";
        $page .= "<th>".$lang['mess_subject']."</th>";
        $page .= "</tr>";

        if ($MessCategory == 100) {
            $UsrMess       = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' ORDER BY `message_time` DESC;", 'messages');

            // Mark all user messages as read
            doquery("UPDATE {{table}} SET `message_unread` = 0 WHERE `message_owner` = {$user['id']}", 'messages');

            while ($CurMess = mysql_fetch_array($UsrMess)) {
                $page .= "\n<tr>";
                $page .= "<input name=\"showmes". $CurMess['message_id'] . "\" type=\"hidden\" value=\"1\">";
                $page .= "<th><input name=\"delmes". $CurMess['message_id'] . "\" type=\"checkbox\"></th>";
                $page .= "<th>". date("m-d H:i:s O", $CurMess['message_time']) ."</th>";
                $page .= "<th>". stripslashes( $CurMess['message_from'] ) ."</th>";
                $page .= "<th>". stripslashes( $CurMess['message_subject'] ) ." ";
                if ($CurMess['message_type'] == 1) {
                    $page .= "<a href=\"messages.php?mode=write&amp;id=". $CurMess['message_sender'] ."&amp;subject=".$lang['mess_answer_prefix'] . htmlspecialchars( $CurMess['message_subject']) ."\">";
                    $page .= "<img src=\"". $dpath ."img/m.gif\" alt=\"".$lang['mess_answer']."\" border=\"0\"></a></th>";
                } else {
                    $page .= "</th>";
                }
                $page .= "</tr><tr>";
                $page .= "<td style=\"background-color: ".$BackGndColor[$CurMess['message_type']]."; background-image: none;\"; class=\"b\"> </td>";
                $page .= "<td style=\"background-color: ".$BackGndColor[$CurMess['message_type']]."; background-image: none;\"; colspan=\"3\" class=\"b\">". stripslashes( nl2br( $CurMess['message_text'] ) ) ."</td>";
                $page .= "</tr>";
            }
        } else {
            $UsrMess       = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' AND `message_type` = '".$MessCategory."' ORDER BY `message_time` DESC;", 'messages');

            // Mark messages from given category as read
            doquery("UPDATE {{table}} SET `message_unread` = 0 WHERE `message_type` = '{$MessCategory}' AND `message_owner` = {$user['id']}", 'messages');

            while ($CurMess = mysql_fetch_array($UsrMess)) {
                if ($CurMess['message_type'] == $MessCategory) {
                    $page .= "\n<tr>";
                    $page .= "<input name=\"showmes". $CurMess['message_id'] . "\" type=\"hidden\" value=\"1\">";
                    $page .= "<th><input name=\"delmes". $CurMess['message_id'] ."\" type=\"checkbox\"></th>";
                    $page .= "<th>". date("m-d H:i:s O", $CurMess['message_time']) ."</th>";
                    $page .= "<th>". stripslashes( $CurMess['message_from'] ) ."</th>";
                    $page .= "<th>". stripslashes( $CurMess['message_subject'] ) ." ";
                    if ($CurMess['message_type'] == 1) {
                        $page .= "<a href=\"messages.php?mode=write&amp;id=". $CurMess['message_sender'] ."&amp;subject=".$lang['mess_answer_prefix'] . htmlspecialchars( $CurMess['message_subject']) ."\">";
                        $page .= "<img src=\"". $dpath ."img/m.gif\" alt=\"".$lang['mess_answer']."\" border=\"0\"></a></th>";
                    } else {
                        $page .= "</th>";
                    }
                    $page .= "</tr><tr>";
                    $page .= "<td class=\"b\"> </td>";
                    $page .= "<td colspan=\"3\" class=\"b\">". nl2br( stripslashes( $CurMess['message_text'] ) ) ."</td>";
                    $page .= "</tr>";
                }
            }
        }


        $page .= "<tr>";
        $page .= "<th style=\"color: rgb(242, 204, 74);\" colspan=\"4\">";
        $page .= "<input onchange=\"document.getElementById('fullreports2').checked=this.checked\" id=\"fullreports\" name=\"fullreports\" type=\"checkbox\">".$lang['mess_partialreport']."</th>";
        $page .= "</tr><tr>";
        $page .= "<th colspan=\"4\">";
        $page .= "<select onchange=\"document.getElementById('deletemessages2').options[this.selectedIndex].selected='true'\" id=\"deletemessages\" name=\"deletemessages\">";
        $page .= "<option value=\"deletemarked\">".$lang['mess_deletemarked']."</option>";
        $page .= "<option value=\"deleteunmarked\">".$lang['mess_deleteunmarked']."</option>";
        $page .= "<option value=\"deleteall\">".$lang['mess_deleteall']."</option>";
        $page .= "</select>";
        $page .= "<input value=\"".$lang['mess_its_ok']."\" type=\"submit\">";
        $page .= "</th>";
        $page .= "</tr><tr>";
        $page .= "<td colspan=\"4\"></td>";
        $page .= "</tr>";
        $page .= "</table>\n";
        $page .= "</td>";
        $page .= "</tr>";
        $page .= "</table>\n";
        $page .= "</form>";
        $page .= "</td>";
        $page .= "</table>\n";
        $page .= "</center>";
        break;

    default:
        $page = "<center>";
        $page .= "<br>";
        $page .= "<table width=\"569\">";
        $page .= "<tr>";
        $page .= "    <td class=\"c\" colspan=\"5\">". $lang['title'] ."</td>";
        $page .= "</tr><tr>";
        $page .= "    <th colspan=\"3\">". $lang['head_type'] ."</th>";
        $page .= "    <th>". $lang['head_count'] ."</th>";
        $page .= "    <th>". $lang['head_total'] ."</th>";
        $page .= "</tr>";
        $page .= "<tr>";
        $page .= "    <th colspan=\"3\"><a href=\"messages.php?mode=show&amp;messcat=100\"><font color=\"". $TitleColor[100] ."\">". $lang['type'][100] ."</a></th>";
        $page .= "    <th><font color=\"". $TitleColor[100] ."\">". $WaitingMess[100] ."</font></th>";
        $page .= "    <th><font color=\"". $TitleColor[100] ."\">". $TotalMess[100] ."</font></th>";
        $page .= "</tr>";
        for ($MessType = 0; $MessType < 100; $MessType++) {
            if ( in_array($MessType, $MessageType) ) {
                $page .= "<tr>";
                $page .= "    <th colspan=\"3\"><a href=\"messages.php?mode=show&amp;messcat=". $MessType ." \"><font color=\"". $TitleColor[$MessType] ."\">". $lang['type'][$MessType] ."</a></th>";
                $page .= "    <th><font color=\"". $TitleColor[$MessType] ."\">". $WaitingMess[$MessType] ."</font></th>";
                $page .= "    <th><font color=\"". $TitleColor[$MessType] ."\">". $TotalMess[$MessType] ."</font></th>";
                $page .= "</tr>";
            }
        }
        $page .= "</table>";
        $page .= "</center>";
        break;
}

display($page, $lang['mess_pagetitle']);

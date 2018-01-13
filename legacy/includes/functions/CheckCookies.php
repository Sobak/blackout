<?php

/**
 * Authenticate the user.
 *
 * Checks authentication cookie and returns user's database record if everything
 * was correct, empty array otherwise.
 *
 * Cookie structure:
 * 0 => id
 * 1 => username
 * 2 => hash of password + secret word
 * 3 => "remember me" status
 *
 * @return array
 */
function CheckCookies()
{
    global $dbsettings, $game_config, $lang;

    $UserRow = array();

    if (isset($_COOKIE[$game_config['COOKIE_NAME']])) {
        $TheCookie  = explode("/%/", $_COOKIE[$game_config['COOKIE_NAME']]);
        $UserCount = doquery("SELECT COUNT(*) FROM {{table}} WHERE `username` = '". $TheCookie[1]. "';", 'users', true);
        $UserResult = doquery("SELECT * FROM {{table}} WHERE `username` = '". $TheCookie[1]. "';", 'users');

        // Check if there was exactly one record for that name
        if ($UserCount[0] != 1) {
            message($lang['sys_cookie_problem'], $lang['sys_error'], null, 0, false);
        }

        $UserRow    = mysql_fetch_array($UserResult);

        // Check if coookie's UserID and password are correct
        $checkID = $UserRow["id"] === $TheCookie[0];
        $checkPassword = md5($UserRow["password"] . "--" . $dbsettings["secretword"]) === $TheCookie[2];

        if ($checkID === false || $checkPassword === false) {
            message($lang['sys_cookie_problem'], $lang['sys_error'], null, 0, false);
        }

        // Check if the password is correct
        if (md5($UserRow["password"] . "--" . $dbsettings["secretword"]) !== $TheCookie[2]) {
            message($lang['cookies']['Error3'], $lang['sys_error'], null, 0, false);
        }

        $NextCookie = implode("/%/", $TheCookie);
        // If an old cookie had "remember me" enabled, set expiration time in one year
        if ($TheCookie[3] == 1) {
            $ExpireTime = time() + 31536000;
        } else {
            $ExpireTime = 0;
        }

        setcookie($game_config['COOKIE_NAME'], $NextCookie, $ExpireTime, "/", "", 0);
        $QryUpdateUser  = "UPDATE {{table}} SET ";
        $QryUpdateUser .= "`onlinetime` = '". time() ."', ";
        $QryUpdateUser .= "`user_lastip` = '". $_SERVER['REMOTE_ADDR'] ."', ";
        $QryUpdateUser .= "`user_agent` = '". mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']) ."' ";
        $QryUpdateUser .= "WHERE ";
        $QryUpdateUser .= "`id` = '". $TheCookie[0] ."' LIMIT 1;";
        doquery( $QryUpdateUser, 'users');
    }

    return $UserRow;
}

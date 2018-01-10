<?php

define('INSIDE'  , true);

session_start();

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('reg');

$availableLanguages = getAvailableLanguages();

$kod = md5(rand(100000,9000000));
function sendpassemail($emailaddress, $password) {
    global $lang, $kod;

    $parse['gameurl']  = GAMEURL;
    $parse['password'] = $password;
    $parse['kod']      = $kod;
    $email             = parsetemplate($lang['mail_welcome'], $parse);

    return SendEmail($emailaddress, $lang['mail_title'], $email);
}

if ($_POST) {
    $errorlist = '';

    if (is_email($_POST['email']) === false) {
        $errorlist .= $lang['error_mail'];
    }

    if ($_SESSION['captcha'] != $_POST["captcha"]) {
        $errorlist .= $lang['error_captcha'];
    }

    if (!$_POST['planet']) {
        $errorlist .= $lang['error_planet'];
    }

    if (preg_match("/[^A-z0-9_\-]/", $_POST['hplanet']) == 1) {
        $errorlist .= $lang['error_planetnum'];
    }

    if (!$_POST['character']) {
        $errorlist .= $lang['error_character'];
    }

    if (strlen($_POST['passwrd']) < 4) {
        $errorlist .= $lang['error_password'];
    }

    if (preg_match("/[^A-z0-9_\-]/", $_POST['character']) == 1) {
        $errorlist .= $lang['error_charalpha'];
    }

    if ($_POST['rgt'] != 'on') {
        $errorlist .= $lang['error_rgt'];
    }

    // Check if username is taken
    $ExistUser = doquery("SELECT `username` FROM {{table}} WHERE `username` = '". mysql_escape_string($_POST['character']) ."' LIMIT 1;", 'users', true);
    if ($ExistUser) {
        $errorlist .= $lang['error_userexist'];
    }

    // Check if email is taken
    $ExistMail = doquery("SELECT `email` FROM {{table}} WHERE `email` = '". mysql_escape_string($_POST['email']) ."' LIMIT 1;", 'users', true);
    if ($ExistMail) {
        $errorlist .= $lang['error_emailexist'];
    }

    if (!in_array($_POST['langer'], array_keys($availableLanguages))) {
        $errorlist .= $lang['error_lang'];
    }

    if ($errorlist) {
        $errorlist .= '<p><a href="reg.php">' . $lang['error_returnback'] . '</a></p>';

        message ($errorlist, $lang['Register']);
    }

    $newpass        = $_POST['passwrd'];
    $UserName       = CheckInputStrings($_POST['character']);
    $UserEmail      = CheckInputStrings($_POST['email']);
    $UserPlanet     = CheckInputStrings($_POST['planet']);

    $md5newpass     = md5($newpass);
    $aktywacja = time()+2678400;
    // Creation de l'utilisateur
    $QryInsertUser  = "INSERT INTO {{table}} SET ";
    $QryInsertUser .= "`username` = '". mysql_escape_string(strip_tags( $UserName )) ."', ";
    $QryInsertUser .= "`email` = '".    mysql_escape_string( $UserEmail )            ."', ";
    $QryInsertUser .= "`email_2` = '".  mysql_escape_string( $UserEmail )            ."', ";
    $QryInsertUser .= "`lang` = '".     mysql_escape_string( $_POST['langer'] )      ."', ";
    $QryInsertUser .= "`id_planet` = '0', ";
    $QryInsertUser .= "`register_time` = '". time() ."', ";
    $QryInsertUser .= "`password`='". $md5newpass ."', ";
    $QryInsertUser .= "`aktywnosc` = '1', ";
    $QryInsertUser .= "`kod_aktywujacy`='". mysql_escape_string( $kod )              ."', ";
    $QryInsertUser .= "`time_aktyw`='".     mysql_escape_string( $aktywacja )        ."';";
    doquery( $QryInsertUser, 'users');

    // Get ID of the registered user
    $userID = mysql_insert_id();

    // Search for a free place
    $LastSettedGalaxyPos  = $game_config['LastSettedGalaxyPos'];
    $LastSettedSystemPos  = $game_config['LastSettedSystemPos'];
    $LastSettedPlanetPos  = $game_config['LastSettedPlanetPos'];
    while (!isset($newpos_checked)) {
        for ($Galaxy = $LastSettedGalaxyPos; $Galaxy <= MAX_GALAXY_IN_WORLD; $Galaxy++) {
            for ($System = $LastSettedSystemPos; $System <= MAX_SYSTEM_IN_GALAXY; $System++) {
                for ($Posit = $LastSettedPlanetPos; $Posit <= 4; $Posit++) {
                    $Planet = round (rand ( 4, 12) );

                    switch ($LastSettedPlanetPos) {
                        case 1:
                            $LastSettedPlanetPos += 1;
                            break;
                        case 2:
                            $LastSettedPlanetPos += 1;
                            break;
                        case 3:
                            if ($LastSettedSystemPos == MAX_SYSTEM_IN_GALAXY) {
                                $LastSettedGalaxyPos += 1;
                                $LastSettedSystemPos  = 1;
                                $LastSettedPlanetPos  = 1;
                                break;
                            } else {
                                $LastSettedPlanetPos  = 1;
                            }
                            $LastSettedSystemPos += 1;
                            break;
                    }
                    break;
                }
                break;
            }
            break;
        }

        $QrySelectGalaxy  =    "SELECT * ";
        $QrySelectGalaxy .= "FROM {{table}} ";
        $QrySelectGalaxy .= "WHERE ";
        $QrySelectGalaxy .= "`galaxy` = '". $Galaxy ."' AND ";
        $QrySelectGalaxy .= "`system` = '". $System ."' AND ";
        $QrySelectGalaxy .= "`planet` = '". $Planet ."' ";
        $QrySelectGalaxy .= "LIMIT 1;";
        $GalaxyRow = doquery( $QrySelectGalaxy, 'galaxy', true);

        if ($GalaxyRow["id_planet"] == "0") {
            $newpos_checked = true;
        }

        if (!$GalaxyRow) {
            CreateOnePlanetRecord ($Galaxy, $System, $Planet, $userID, $UserPlanet, true);
            $newpos_checked = true;
        }
        if ($newpos_checked) {
            doquery("UPDATE {{table}} SET `config_value` = '". $LastSettedGalaxyPos ."' WHERE `config_name` = 'LastSettedGalaxyPos';", 'config');
            doquery("UPDATE {{table}} SET `config_value` = '". $LastSettedSystemPos ."' WHERE `config_name` = 'LastSettedSystemPos';", 'config');
            doquery("UPDATE {{table}} SET `config_value` = '". $LastSettedPlanetPos ."' WHERE `config_name` = 'LastSettedPlanetPos';", 'config');
        }
    }
    // Get ID of a freshly created planet
    $PlanetID = doquery("SELECT `id` FROM {{table}} WHERE `id_owner` = '$userID' LIMIT 1;", 'planets', true);

    // Update the user record with the information of his mother planet
    $QryUpdateUser  = "UPDATE {{table}} SET ";
    $QryUpdateUser .= "`id_planet` = '". $PlanetID['id'] ."', ";
    $QryUpdateUser .= "`current_planet` = '". $PlanetID['id'] ."', ";
    $QryUpdateUser .= "`galaxy` = '". $Galaxy ."', ";
    $QryUpdateUser .= "`system` = '". $System ."', ";
    $QryUpdateUser .= "`planet` = '". $Planet ."' ";
    $QryUpdateUser .= "WHERE ";
    $QryUpdateUser .= "`id` = '$userID'";
    $QryUpdateUser .= "LIMIT 1;";
    doquery( $QryUpdateUser, 'users');

    $Message  = $lang['thanksforregistry'];
    if (sendpassemail($_POST['email'], "$newpass")) {
        $Message .= " (" . htmlentities($_POST["email"]) . ")";
    } else {
        $Message .= " (" . htmlentities($_POST["email"]) . ")";
        $Message .= "<br><br>". $lang['error_mailsend'] ." <b>" . $newpass . "</b>";
    }
    message($Message, $lang['reg_welldone']);
} else {
    // Show the signup form
    $parse               = $lang;
    $parse['servername'] = $game_config['game_name'];

    foreach ($availableLanguages as $key => $name) {
        $parse['languages'] .= "<option value='$key'>$name</option>\n";
    }

    display(parsetemplate(gettemplate('registry_form'), $parse), $lang['registry'], false);
}

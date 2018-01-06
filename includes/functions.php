<?php

/**
 * functions.php
 *
 * @version 1
 * @copyright 2008 By Chlorel for XNova
 */

// ----------------------------------------------------------------------------------------------------------------
//
// Routine pour la gestion du mode vacance
//
function check_urlaubmodus ($user) {
    if ($user['urlaubs_modus'] == 1) {
        message("Vous �tes en mode vacances!", $title = $user['username'], $dest = "", $time = "3");
    }
}

function check_urlaubmodus_time () {
    global $user, $game_config;
    if ($game_config['urlaubs_modus_erz'] == 1) {
        $begrenzung = 86400; //24x60x60= 24h
        $iduser = $user["id"];
        $urlaub_modus_time = $user['urlaubs_modus_time'];
        $urlaub_modus_time_soll = $urlaub_modus_time + $begrenzung;
        $time_jetzt = time();
        if ($user['urlaubs_modus'] == 1 && $urlaub_modus_time_soll > $time_jetzt) {
            $soll_datum = date("d.m.Y", $urlaub_modus_time_soll);
            $soll_uhrzeit = date("H:i:s", $urlaub_modus_time_soll);
        message("Vous �tes en mode vacances!<br>Le mode vacance dure jusque $soll_datum $soll_uhrzeit<br>    Ce n'est qu'apr�s cette p�riode que vous pouvez changer vos options.", "Mode vacance");
        }
        elseif ($user['urlaubs_modus'] == 1 && $urlaub_modus_time_soll < $time_jetzt) {
            doquery("UPDATE {{table}} SET
                `urlaubs_modus` = '0',
                `urlaubs_modus_time` = '0'
                WHERE `id` = '$iduser' LIMIT 1", "users");
        }
    }
}

// ----------------------------------------------------------------------------------------------------------------
//
// Function checking correctness of an email address
//
function is_email($email) {
    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}

// ----------------------------------------------------------------------------------------------------------------
//
// Function displaying a message with jump to another page if desired
//
function message($message, $title = 'Error', $destination = null, $time = 3, $in_admin = false)
{
    $parse['title'] = $title;
    $parse['message']   = $message;

    $page = parsetemplate(gettemplate('message_body'), $parse);

    if ($destination) {
        $headers = "<meta http-equiv=\"refresh\" content=\"$time;URL=javascript:self.location='$destination';\">";
    } else {
        $headers = '';
    }

    display($page, $title, false, $headers, $in_admin);
}

function AdminMessage($message, $title = 'Error', $destination = null, $time = 3) {
    message($message, $title, $destination, $time, true);
}

// ----------------------------------------------------------------------------------------------------------------
//
// Routine d'affichage d'une page dans un cadre donn�
//
// $page      -> la page
// $title     -> le titre de la page
// $topnav    -> Affichage des ressources ? oui ou non ??
// $metatags  -> S'il y a quelques actions particulieres a faire ...
// $AdminPage -> Si on est dans la section admin ... faut le dire ...
function display ($page, $title = '', $topnav = true, $metatags = '', $AdminPage = false) {
    global $link, $game_config, $debug, $user, $planetrow;

    if (!$AdminPage) {
        $DisplayPage  = StdUserHeader ($title, $metatags);
    } else {
        $DisplayPage  = AdminUserHeader ($title, $metatags);
    }

    if ($topnav) {

        if ($user['aktywnosc'] == 1) {
            $urlaub_act_time = $user['time_aktyw'];
            $act_datum = date("d.m.Y", $urlaub_act_time);
            $act_uhrzeit = date("H:i:s", $urlaub_act_time);
        $DisplayPage .= "Le mode del dure jusque $act_datum $act_uhrzeit<br>    Ce n'est qu'apr�s cette p�riode que vous pouvez changer vos options.";
        }

        if ($user['db_deaktjava'] == 1) {
            $urlaub_del_time = $user['deltime'];
            $del_datum = date("d.m.Y", $urlaub_del_time);
            $del_uhrzeit = date("H:i:s", $urlaub_del_time);
        $DisplayPage .= "Vous �tes en del user!<br>Le mode del dure jusque $del_datum $del_uhrzeit<br>    Ce n'est qu'apr�s cette p�riode que vous pouvez changer vos options.";
        }

        $DisplayPage .= ShowTopNavigationBar( $user, $planetrow );
    }
    $DisplayPage .= "<center>\n". $page ."\n</center>\n";
    // Affichage du Debug si necessaire
    if (isset($user['authlevel']) && ($user['authlevel'] == 1 || $user['authlevel'] == 3)) {
        if ($game_config['debug'] == 1) $debug->echo_log();
    }

    $DisplayPage .= StdFooter();
    if (isset($link)) {
        mysql_close();
    }

    echo $DisplayPage;

    die();
}

// ----------------------------------------------------------------------------------------------------------------
//
// Entete de page
//
function StdUserHeader ($title = '', $metatags = '') {
    global $user, $dpath, $langInfos;

    $dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];

    $parse           = $langInfos;
    $parse['dpath']  = $dpath;
    $parse['title']  = $title;
    $parse['-meta-'] = ($metatags) ? $metatags : "";
    $parse['-body-'] = "<body>"; //  class=\"style\" topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
    return parsetemplate(gettemplate('simple_header'), $parse);
}

// ----------------------------------------------------------------------------------------------------------------
//
// Entete de page administration
//
function AdminUserHeader ($title = '', $metatags = '') {
    global $user, $dpath, $langInfos;

    $dpath = isset($user['dpath']) && !empty($user['dpath']) ? $user['dpath'] : DEFAULT_SKINPATH;

    $parse           = $langInfos;
    $parse['dpath']  = $dpath;
    $parse['title']  = $title;
    $parse['-meta-'] = ($metatags) ? $metatags : "";
    $parse['-body-'] = "<body>"; //  class=\"style\" topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
    return parsetemplate(gettemplate('admin/simple_header'), $parse);
}

// ----------------------------------------------------------------------------------------------------------------
//
// Pied de page
//
function StdFooter() {
    global $game_config, $lang;
    $parse['copyright']     = $game_config['copyright'];
    $parse['TranslationBy'] = $lang['TranslationBy'];
    return parsetemplate(gettemplate('overall_footer'), $parse);
}

// ----------------------------------------------------------------------------------------------------------------
//
// Calculate available space on the planet
//
function CalculateMaxPlanetFields($planet) {
    global $resource;

    if($planet["planet_type"] == 3) {
        return $planet["field_max"] + ($planet[ $resource[41] ] * 3);
    }

    return $planet["field_max"] + ($planet[ $resource[33] ] * 5);
}

/**
 * Restrict access to users with level given or higher.
 *
 * @param array $user
 * @param int $minLevel
 * @return void
 */
function restrictAccess($user, $minLevel)
{
    global $lang;

    if ($user['authlevel'] < $minLevel) {
        AdminMessage($lang['sys_noalloaw'], $lang['sys_noaccess']);
    }
}

<?php

/**
 * Redirects user to specified target URL.
 *
 * @param $target
 */
function redirect_to($target)
{
    header("Location: $target");
    die;
}

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

/**
 * Display generic message.
 *
 * @param string $message Message content
 * @param string $title Message title
 * @param null $destination Optional destination to redirect the user to
 * @param int $time Time after which redirect will happen
 * @param bool $hasNavigation Whether to show navigation
 */
function message($message, $title = 'Error', $destination = null, $time = 3, $hasNavigation = true)
{
    $parse['title'] = $title;
    $parse['message']   = $message;

    $page = parsetemplate(gettemplate('message_body'), $parse);

    $headers = '';
    if ($destination) {
        $headers = "<meta http-equiv='refresh' content='$time;URL=$destination'>";
    }

    display($page, $title, $hasNavigation, $headers);
}

/**
 * Display generic message box.
 *
 * Same as above but displays just a message box which can be placed anywhere
 * on the website, thus doesn't provide features like redirect or controlling
 * the navigation.
 *
 * @param string $message Message content
 * @param string $title Message title
 * @return string
 */
function message_simple($message, $title = 'Error')
{
    $parse['title'] = $title;
    $parse['message']   = $message;

    return parsetemplate(gettemplate('message_body'), $parse);
}

/**
 * Display the page.
 *
 * @param string $content Page content
 * @param string $title Page title
 * @param bool $hasNavigation Whether to show navigation
 * @param string $metatags Optional metatags to inject into header
 */
function display($content, $title = '', $hasNavigation = true, $metatags = '') {
    global $game_config, $debug, $lang, $user, $planetrow;

    $DisplayPage = ShowHeader($title, $metatags);

    if ($hasNavigation || (defined('IN_ADMIN') && IN_ADMIN == true)) {
        $template = 'left_menu';

        if (defined('IN_ADMIN') && IN_ADMIN == true) {
            if ($user['authlevel'] == LEVEL_OPERATOR) {
                $template = 'admin/left_menu_modo';
            } elseif ($user['authlevel'] == LEVEL_SUPER_OPERATOR) {
                $template = 'admin/left_menu_op';
            } elseif ($user['authlevel'] >= LEVEL_ADMIN) {
                $template = 'admin/left_menu';
            }
        }

        $DisplayPage .= ShowLeftMenu($template, $user);
    }

    if ($hasNavigation) {
        $DisplayPage .= ShowTopNavigationBar($user, $planetrow);

        if ($user['aktywnosc'] == 1) {
            $activationDate = date('d.m.Y H:i', $user['time_aktyw']);

            $DisplayPage .= message_simple(
                sprintf($lang['sys_activate_acc_text'], $activationDate),
                $lang['sys_activate_acc_title']
            );
        }

        if ($user['db_deaktjava'] == 1) {
            $deletionDate = date('d.m.Y H:i', $user['deltime']);

            $DisplayPage .= message_simple(
                sprintf($lang['sys_acc_deletion_text'], $deletionDate),
                $lang['sys_acc_deletion_title']
            );
        }
    }

    $DisplayPage .= "<center>\n". $content ."\n</center>\n";

    // Append debug if necessary
    if (isset($user['authlevel']) && $user['authlevel'] > LEVEL_PLAYER && $game_config['debug']) {
        $DisplayPage .= $debug->getLog();
    }

    $DisplayPage .= gettemplate('simple_footer');

    echo $DisplayPage;

    die();
}

/**
 * Render generic page header.
 *
 * @param string $title
 * @param string $metatags
 * @return string
 */
function ShowHeader($title, $metatags) {
    global $dpath, $langInfos;

    $parse           = $langInfos;
    $parse['base']   = (defined('IN_ADMIN') && IN_ADMIN) ? '../' : '';
    $parse['dpath']  = isset($dpath) ? $dpath : 'skins/' . DEFAULT_SKIN . '/';
    $parse['title']  = $title;
    $parse['-meta-'] = $metatags;

    return parsetemplate(gettemplate('simple_header'), $parse);
}

/**
 * Renders left menu.
 *
 * @param string $template Template of the menu
 * @param array $user User database record
 * @return string
 */
function ShowLeftMenu($template, array $user)
{
    global $game_config, $lang;

    includeLang('leftmenu');

    $parse                    = $lang;
    $parse['lm_tx_serv']      = $game_config['resource_multiplier'];
    $parse['lm_tx_game']      = $game_config['game_speed'] / 2500;
    $parse['lm_tx_fleet']     = $game_config['fleet_speed'] / 2500;
    $parse['lm_tx_queue']     = MAX_FLEET_OR_DEFS_PER_ROW;
    $parse['server_info']     = parsetemplate(gettemplate('serv_infos'), $parse);
    $parse['XNovaRelease']    = \App\Services\Blackout::VERSION;
    $parse['forum_url']       = $game_config['forum_url'];
    $parse['servername']      = $game_config['game_name'];

    if ($user['authlevel'] > LEVEL_PLAYER) {
        $text = $lang['user_level'][$user['authlevel']];
        $parse['ADMIN_LINK']  = '<tr><td><a href="admin/overview.php" style="color:lime">' . $text . '</a></td></tr>';
    }

    return parsetemplate(gettemplate($template), $parse);
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
        message($lang['sys_noalloaw'], $lang['sys_noaccess']);
    }
}

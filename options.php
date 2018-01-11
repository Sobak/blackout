<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('options');

$lang['PHP_SELF'] = 'options.php';

$dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
$mode = $_GET['mode'];

if ($_POST && $mode == "change") {
    $iduser = $user["id"];
    $dpath = $_POST["dpath"];
    $language = $_POST["langer"];

    // Handle special admin options
    if ($user['authlevel'] > LEVEL_PLAYER) {
        $planetLevel = $_POST['adm_pl_prot'] == 'on' ? $user['authlevel'] : 0;

        doquery("UPDATE {{table}} SET `id_level` = {$planetLevel} WHERE `id_owner` = {$user['id']}", 'planets');
    }

    // Deactivate IP checking?
    if (isset($_POST["noipcheck"]) && $_POST["noipcheck"] == 'on') {
        $noipcheck = "1";
    } else {
        $noipcheck = "0";
    }
    // Username
    if (isset($_POST["db_character"]) && $_POST["db_character"] != '') {
        $username = CheckInputStrings ( $_POST['db_character'] );
    } else {
        $username = $user['username'];
    }
    // Email address
    if (isset($_POST["db_email"]) && $_POST["db_email"] != '') {
        $db_email = CheckInputStrings ( $_POST['db_email'] );
    } else {
        $db_email = $user['email'];
    }
    // Number of spy probes
    if (isset($_POST["spio_anz"]) && is_numeric($_POST["spio_anz"])) {
        $spio_anz = $_POST["spio_anz"];
    } else {
        $spio_anz = "1";
    }
    // Tooltip duration
    if (isset($_POST["settings_tooltiptime"]) && is_numeric($_POST["settings_tooltiptime"])) {
        $settings_tooltiptime = $_POST["settings_tooltiptime"];
    } else {
        $settings_tooltiptime = "1";
    }
    // Maximum fleet messages
    if (isset($_POST["settings_fleetactions"]) && is_numeric($_POST["settings_fleetactions"])) {
        $settings_fleetactions = $_POST["settings_fleetactions"];
    } else {
        $settings_fleetactions = "1";
    }
    // Display alliance logo
    if (isset($_POST["settings_allylogo"]) && $_POST["settings_allylogo"] == 'on') {
        $settings_allylogo = "1";
    } else {
        $settings_allylogo = "0";
    }
    // "Spy" shortcut
    if (isset($_POST["settings_esp"]) && $_POST["settings_esp"] == 'on') {
        $settings_esp = "1";
    } else {
        $settings_esp = "0";
    }
    // "Message" shortcut
    if (isset($_POST["settings_wri"]) && $_POST["settings_wri"] == 'on') {
        $settings_wri = "1";
    } else {
        $settings_wri = "0";
    }
    // "Friends" shortcut
    if (isset($_POST["settings_bud"]) && $_POST["settings_bud"] == 'on') {
        $settings_bud = "1";
    } else {
        $settings_bud = "0";
    }
    // "Missiles" shortcut
    if (isset($_POST["settings_mis"]) && $_POST["settings_mis"] == 'on') {
        $settings_mis = "1";
    } else {
        $settings_mis = "0";
    }
    // "Report" shortcut
    if (isset($_POST["settings_rep"]) && $_POST["settings_rep"] == 'on') {
        $settings_rep = "1";
    } else {
        $settings_rep = "0";
    }
    // Vacations mode
    if (isset($_POST["urlaubs_modus"]) && $_POST["urlaubs_modus"] == 'on') {
        $urlaubs_modus = "1";
        $urlaubs_modus_time = time();
    } else {
        $urlaubs_modus = "0";
        $urlaubs_modus_time = "0";
    }
    // Account deletion
    if (isset($_POST["db_deaktjava"]) && $_POST["db_deaktjava"] == 'on') {
        $db_deaktjava = "1";
        $Del_Time = time()+604800;
    } else {
        $db_deaktjava = "0";
        $Del_Time = "0";
    }
    $SetSort  = $_POST['settings_sort'];
    $SetOrder = $_POST['settings_order'];

    doquery("UPDATE {{table}} SET
    `email` = '$db_email',
    `lang` = '$language',
    `dpath` = '$dpath',
    `noipcheck` = '$noipcheck',
    `planet_sort` = '$SetSort',
    `planet_sort_order` = '$SetOrder',
    `spio_anz` = '$spio_anz',
    `settings_tooltiptime` = '$settings_tooltiptime',
    `settings_fleetactions` = '$settings_fleetactions',
    `settings_allylogo` = '$settings_allylogo',
    `settings_esp` = '$settings_esp',
    `settings_wri` = '$settings_wri',
    `settings_bud` = '$settings_bud',
    `settings_mis` = '$settings_mis',
    `settings_rep` = '$settings_rep',
    `urlaubs_modus` = '$urlaubs_modus',
    `db_deaktjava` = '$db_deaktjava',
    `urlaubs_modus_time` = '$urlaubs_modus_time',
    `deltime` = '$Del_Time'
    WHERE `id` = '$iduser' LIMIT 1", "users");

    if (isset($_POST["db_password"]) && md5($_POST["db_password"]) == $user["password"]) {
        if ($_POST["newpass1"] == $_POST["newpass2"] && strlen($_POST["newpass1"]) >= 4) {
            $newpass = md5($_POST["newpass1"]);
            doquery("UPDATE {{table}} SET `password` = '{$newpass}' WHERE `id` = '{$user['id']}' LIMIT 1", "users");
            setcookie(COOKIE_NAME, "", time()-100000, "/", "", 0); //le da el expire
            message($lang['succeful_changepass'], $lang['changue_pass']);
        }
    }
    if ($user['username'] != $_POST["db_character"]) {
        $query = doquery("SELECT id FROM {{table}} WHERE username='{$_POST["db_character"]}'", 'users', true);
        if (!$query) {
            doquery("UPDATE {{table}} SET username='{$username}' WHERE id='{$user['id']}' LIMIT 1", "users");
            setcookie(COOKIE_NAME, "", time()-100000, "/", "", 0); //le da el expire
            message($lang['succeful_changename'], $lang['changue_name']);
        }
    }
    message($lang['succeful_save'], $lang['Options']);
} else {
    $parse = $lang;

    $parse['dpath'] = $dpath;
    $parse['opt_lst_skin_data']  = "<option value =\"skins/xnova/\">skins/xnova/</option>";
    $parse['opt_lst_ord_data']   = "<option value =\"0\"". (($user['planet_sort'] == 0) ? " selected": "") .">". $lang['opt_lst_ord0'] ."</option>";
    $parse['opt_lst_ord_data']  .= "<option value =\"1\"". (($user['planet_sort'] == 1) ? " selected": "") .">". $lang['opt_lst_ord1'] ."</option>";
    $parse['opt_lst_ord_data']  .= "<option value =\"2\"". (($user['planet_sort'] == 2) ? " selected": "") .">". $lang['opt_lst_ord2'] ."</option>";

    $parse['opt_lst_cla_data']   = "<option value =\"0\"". (($user['planet_sort_order'] == 0) ? " selected": "") .">". $lang['opt_lst_cla0'] ."</option>";
    $parse['opt_lst_cla_data']  .= "<option value =\"1\"". (($user['planet_sort_order'] == 1) ? " selected": "") .">". $lang['opt_lst_cla1'] ."</option>";

    $availableLanguages = getAvailableLanguages();

    foreach ($availableLanguages as $key => $name) {
        $parse['opt_lst_lang_data'] .= "<option value='$key'" . (($user['lang'] == $key) ? " selected" : "") .">". $name ."</option>";
    }

    if ($user['authlevel'] > 0) {
        $FrameTPL = gettemplate('options_admadd');
        $IsProtOn = doquery ("SELECT `id_level` FROM {{table}} WHERE `id_owner` = '".$user['id']."' LIMIT 1;", 'planets', true);
        $bloc['opt_adm_title']       = $lang['opt_adm_title'];
        $bloc['opt_adm_planet_prot'] = $lang['opt_adm_planet_prot'];
        $bloc['adm_pl_prot_data']    = ($IsProtOn['id_level'] > 0) ? " checked='checked'/":'';
        $parse['opt_adm_frame']      = parsetemplate($FrameTPL, $bloc);
    }

    $parse['opt_usern_data'] = $user['username'];
    $parse['opt_mail1_data'] = $user['email'];
    $parse['opt_mail2_data'] = $user['email_2'];
    $parse['opt_dpath_data'] = $user['dpath'];
    $parse['opt_probe_data'] = $user['spio_anz'];
    $parse['opt_toolt_data'] = $user['settings_tooltiptime'];
    $parse['opt_fleet_data'] = $user['settings_fleetactions'];
    $parse['opt_noipc_data'] = ($user['noipcheck'] == 1) ? " checked='checked'":'';
    $parse['opt_allyl_data'] = ($user['settings_allylogo'] == 1) ? " checked='checked'/":'';
    $parse['opt_delac_data'] = ($user['db_deaktjava'] == 1) ? " checked='checked'/":'';
    $parse['opt_modev_data'] = ($user['urlaubs_modus'] == 1)?" checked='checked'/":'';
    $parse['user_settings_rep'] = ($user['settings_rep'] == 1) ? " checked='checked'/":'';
    $parse['user_settings_esp'] = ($user['settings_esp'] == 1) ? " checked='checked'/":'';
    $parse['user_settings_wri'] = ($user['settings_wri'] == 1) ? " checked='checked'/":'';
    $parse['user_settings_mis'] = ($user['settings_mis'] == 1) ? " checked='checked'/":'';
    $parse['user_settings_bud'] = ($user['settings_bud'] == 1) ? " checked='checked'/":'';

    display(parsetemplate(gettemplate('options_body'), $parse), 'Options');
}

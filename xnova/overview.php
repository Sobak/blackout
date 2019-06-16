<?php

define('INSIDE', true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

$lunarow   = doquery("SELECT * FROM {{table}} WHERE `id_owner` = '".$planetrow['id_owner']."' AND `galaxy` = '".$planetrow['galaxy']."' AND `system` = '".$planetrow['system']."' AND `lunapos` = '".$planetrow['planet']."';", 'lunas', true);

CheckPlanetUsedFields($lunarow);

$mode = $_GET['mode'];
$pl = mysql_escape_string($_GET['pl']);
$_POST['deleteid'] = intval($_POST['deleteid']);

includeLang('overview');

switch ($mode) {
    case 'renameplanet':
        // -----------------------------------------------------------------------------------------------
        if ($_POST['action'] == $lang['rename_planet']) {
            // Change planet name
            $UserPlanet     = CheckInputStrings ( $_POST['newname'] );
            $newname        = mysql_real_escape_string(strip_tags(trim( $UserPlanet )));
            if ($newname != "") {
                // Already save new planet name in memory (till the page is reloaded)
                $planetrow['name'] = $newname;
                // Alter the database
                doquery("UPDATE {{table}} SET `name` = '$newname' WHERE `id` = '". $user['current_planet'] ."'", 'planets');
                // If this is a moon, change in other table too
                if ($planetrow['planet_type'] == 3) {
                    doquery("UPDATE {{table}} SET `name` = '$newname' WHERE `galaxy` = '".$planetrow['galaxy']."' AND `system` = '".$planetrow['system']."' AND `lunapos` = '".$planetrow['planet']."' LIMIT 1;", "lunas");
                }
            }

        } elseif ($_POST['action'] == $lang['colony_abandon']) {
            // Cas d'abandon d'une colonie
            // Affichage de la forme d'abandon de colonie
            $parse                   = $lang;
            $parse['planet_id']      = $planetrow['id'];
            $parse['galaxy_galaxy']  = $galaxyrow['galaxy'];
            $parse['galaxy_system']  = $galaxyrow['system'];
            $parse['galaxy_planet']  = $galaxyrow['planet'];
            $parse['planet_name']    = $planetrow['name'];

            $page                   .= parsetemplate(gettemplate('overview_deleteplanet'), $parse);

            // On affiche la forme pour l'abandon de la colonie
            display($page, $lang['rename_and_abandon_planet']);

        } elseif ($_POST['kolonieloeschen'] == 1 && $_POST['deleteid'] == $user['current_planet']) {
            // Controle du mot de passe pour abandon de colonie
            if (Hash::check($_POST['pw'], $user['password']) && $user['id_planet'] != $user['current_planet']) {
                $destruyed        = time() + 60 * 60 * 24;

                $QryUpdatePlanet  = "UPDATE {{table}} SET ";
                $QryUpdatePlanet .= "`destruyed` = '".$destruyed."', ";
                $QryUpdatePlanet .= "`id_owner` = '0' ";
                $QryUpdatePlanet .= "WHERE ";
                $QryUpdatePlanet .= "`id` = '".$user['current_planet']."' LIMIT 1;";
                doquery( $QryUpdatePlanet , 'planets');

                $QryUpdateUser    = "UPDATE {{table}} SET ";
                $QryUpdateUser   .= "`current_planet` = `id_planet` ";
                $QryUpdateUser   .= "WHERE ";
                $QryUpdateUser   .= "`id` = '". $user['id'] ."' LIMIT 1";
                doquery( $QryUpdateUser, "users");

                // Tout s'est bien passé ! La colo a été effacée !!
                message($lang['deletemessage_ok']   , $lang['colony_abandon'], 'overview.php?mode=renameplanet');

            } elseif ($user['id_planet'] == $user["current_planet"]) {
                // Et puis quoi encore ??? On ne peut pas effacer la planete mere ..
                // Uniquement les colonies crées apres coup !!!
                message($lang['deletemessage_wrong'], $lang['colony_abandon'], 'overview.php?mode=renameplanet');

            } else {
                // Erreur de saisie du mot de passe je n'efface pas !!!
                message($lang['deletemessage_fail'] , $lang['colony_abandon'], 'overview.php?mode=renameplanet');

            }
        }

        $parse = $lang;

        $parse['planet_id']     = $planetrow['id'];
        $parse['galaxy_galaxy'] = $galaxyrow['galaxy'];
        $parse['galaxy_system'] = $galaxyrow['system'];
        $parse['galaxy_planet'] = $galaxyrow['planet'];
        $parse['planet_name']   = $planetrow['name'];

        $page                  .= parsetemplate(gettemplate('overview_renameplanet'), $parse);

        // On affiche la page permettant d'abandonner OU de renomme une Colonie / Planete
        display($page, $lang['rename_and_abandon_planet']);
        break;

    default:
        // --- Account status messages -------------------------------------------------------------------
        $AccountStatusMessage = '';

        if ($user['aktywnosc'] == 1) {
            $activationDate = date('d.m.Y H:i', $user['time_aktyw']);

            $AccountStatusMessage .= '<tr><th colspan="4">' . sprintf($lang['ov_acc_activate'], $activationDate) . '</th></tr>';
        }

        if ($user['db_deaktjava'] == 1) {
            $deletionDate = date('d.m.Y H:i', $user['deltime']);

            $AccountStatusMessage .= '<tr><th colspan="4">' . sprintf($lang['ov_acc_deletion'], $deletionDate) . '</th></tr>';
        }
        // -----------------------------------------------------------------------------------------------

        // --- Gestion des messages ----------------------------------------------------------------------
        $Have_new_message = "";
        if ($user['new_message'] != 0) {
            $Have_new_message .= "<tr>";
            if ($user['new_message'] == 1) {
                $Have_new_message .= "<th colspan=4><a href=messages.php>". $lang['Have_new_message']."</a></th>";
            } elseif ($user['new_message'] > 1) {
                $Have_new_message .= "<th colspan=4><a href=messages.php>";
                $m = pretty_number($user['new_message']);
                $Have_new_message .= str_replace('%m', $m, $lang['Have_new_messages']);
                $Have_new_message .= "</a></th>";
            }
            $Have_new_message .= "</tr>";
        }
        // -----------------------------------------------------------------------------------------------

        // --- Gestion Officiers -------------------------------------------------------------------------
        // Passage au niveau suivant, ajout du point de compétence et affichage du passage au nouveau level
        $XpMinierUp  = $user['lvl_minier'] * 50;
        $XpRaidUp    = $user['lvl_raid']   * 10;
        $XpMinier    = $user['xpminier'];
        $XPRaid      = $user['xpraid'];

        $LvlUpMinier = $user['lvl_minier'] + 1;
        $LvlUpRaid   = $user['lvl_raid']   + 1;

        if( ($LvlUpMinier + $LvlUpRaid) <= 100 ) {
            if ($XpMinier >= $XpMinierUp) {
                $QryUpdateUser  = "UPDATE {{table}} SET ";
                $QryUpdateUser .= "`lvl_minier` = '".$LvlUpMinier."', ";
                $QryUpdateUser .= "`rpg_points` = `rpg_points` + 1 ";
                $QryUpdateUser .= "WHERE ";
                $QryUpdateUser .= "`id` = '". $user['id'] ."';";
                doquery( $QryUpdateUser, 'users');
                $HaveNewLevelMineur  = "<tr>";
                $HaveNewLevelMineur .= "<th colspan=4><a href=officier.php>". $lang['Have_new_level_mineur']."</a></th>";
            }
            if ($XPRaid >= $XpRaidUp) {
                $QryUpdateUser  = "UPDATE {{table}} SET ";
                $QryUpdateUser .= "`lvl_raid` = '".$LvlUpRaid."', ";
                $QryUpdateUser .= "`rpg_points` = `rpg_points` + 1 ";
                $QryUpdateUser .= "WHERE ";
                $QryUpdateUser .= "`id` = '". $user['id'] ."';";
                doquery( $QryUpdateUser, 'users');
                $HaveNewLevelMineur  = "<tr>";
                $HaveNewLevelMineur .= "<th colspan=4><a href=officier.php>". $lang['Have_new_level_raid']."</a></th>";
            }
        }
        // -----------------------------------------------------------------------------------------------

        // --- Gestion des flottes personnelles ---------------------------------------------------------
        // Toutes de vert vetues
        $OwnFleets       = doquery("SELECT * FROM {{table}} WHERE `fleet_owner` = '". $user['id'] ."';", 'fleets');
        $Record          = 0;
        while ($FleetRow = mysql_fetch_array($OwnFleets)) {
            $Record++;

            $StartTime   = $FleetRow['fleet_start_time'];
            $StayTime    = $FleetRow['fleet_end_stay'];
            $EndTime     = $FleetRow['fleet_end_time'];

            // Flotte a l'aller
            $Label = "fs";
            if ($StartTime > time()) {
                $fpage[$StartTime] = BuildFleetEventTable ( $FleetRow, 0, true, $Label, $Record );
            }

            if ($FleetRow['fleet_mission'] <> 4) {
                // Flotte en stationnement
                $Label = "ft";
                if ($StayTime > time()) {
                    $fpage[$StayTime] = BuildFleetEventTable ( $FleetRow, 1, true, $Label, $Record );
                }

                // Flotte au retour
                $Label = "fe";
                if ($EndTime > time()) {
                    $fpage[$EndTime]  = BuildFleetEventTable ( $FleetRow, 2, true, $Label, $Record );
                }
            }
        } // End While

        // -----------------------------------------------------------------------------------------------

        // --- Gestion des flottes autres que personnelles ----------------------------------------------
        // Flotte ennemies (ou amie) mais non personnelles
        $OtherFleets     = doquery("SELECT * FROM {{table}} WHERE `fleet_target_owner` = '".$user['id']."';", 'fleets');

        $Record          = 2000;
        while ($FleetRow = mysql_fetch_array($OtherFleets)) {
            if ($FleetRow['fleet_owner'] != $user['id']) {
                if ($FleetRow['fleet_mission'] != 8) {
                    $Record++;
                    $StartTime = $FleetRow['fleet_start_time'];
                    $StayTime  = $FleetRow['fleet_end_stay'];

                    if ($StartTime > time()) {
                        $Label = "ofs";
                        $fpage[$StartTime] = BuildFleetEventTable ( $FleetRow, 0, false, $Label, $Record );
                    }
                    if ($FleetRow['fleet_mission'] == 5) {
                        // Flotte en stationnement
                        $Label = "oft";
                        if ($StayTime > time()) {
                            $fpage[$StayTime] = BuildFleetEventTable ( $FleetRow, 1, false, $Label, $Record );
                        }
                    }
                }
            }
        }

        // -----------------------------------------------------------------------------------------------

        // --- Gestion de la liste des planetes ----------------------------------------------------------
        // Planetes ...
        $planets_query = doquery("SELECT * FROM {{table}} WHERE id_owner='{$user['id']}'", "planets");
        $Colone  = 1;

        $AllPlanets = "<tr>";
        while ($UserPlanet = mysql_fetch_array($planets_query)) {
            if ($UserPlanet["id"] != $user["current_planet"] && $UserPlanet['planet_type'] != 3) {
                $AllPlanets .= "<th>". $UserPlanet['name'] ."<br>";
                $AllPlanets .= "<a href=\"?cp=". $UserPlanet['id'] ."&re=0\" title=\"". $UserPlanet['name'] ."\"><img src=\"". $dpath ."planeten/small/s_". $UserPlanet['image'] .".jpg\" height=\"50\" width=\"50\"></a><br>";
                $AllPlanets .= "<center>";

                if ($UserPlanet['b_building'] != 0) {
                    UpdatePlanetBatimentQueueList ( $UserPlanet, $user );
                    if ( $UserPlanet['b_building'] != 0 ) {
                        $BuildQueue      = $UserPlanet['b_building_id'];
                        $QueueArray      = explode ( ";", $BuildQueue );
                        $CurrentBuild    = explode ( ",", $QueueArray[0] );
                        $BuildElement    = $CurrentBuild[0];
                        $BuildLevel      = $CurrentBuild[1];
                        $BuildRestTime   = pretty_time( $CurrentBuild[3] - time() );
                        $AllPlanets     .= '' . $lang['tech'][$BuildElement] . ' (' . $BuildLevel . ')';
                        $AllPlanets     .= "<br><font color=\"#7f7f7f\">(". $BuildRestTime .")</font>";
                    } else {
                        CheckPlanetUsedFields ($UserPlanet);
                        $AllPlanets     .= $lang['Free'];
                    }
                } else {
                    $AllPlanets    .= $lang['Free'];
                }

                $AllPlanets .= "</center></th>";
                if ($Colone <= 1) {
                    $Colone++;
                } else {
                    $AllPlanets .= "</tr><tr>";
                    $Colone      = 1;
                }
            }
        }
        // -----------------------------------------------------------------------------------------------

        // --- Gestion des attaques missiles -------------------------------------------------------------
        $iraks_query = doquery("SELECT * FROM {{table}} WHERE owner = '" . $user['id'] . "'", 'iraks');
        $Record = 4000;
        while ($irak = mysql_fetch_array ($iraks_query)) {
            $Record++;
            $fpage[$irak['zeit']] = '';

            if ($irak['zeit'] > time()) {
                $time = $irak['zeit'] - time();

                $fpage[$irak['zeit']] .= InsertJavaScriptChronoApplet ( "fm", $Record, $time, true );

                $planet_start = doquery("SELECT * FROM {{table}} WHERE
                galaxy = '" . $irak['galaxy'] . "' AND
                system = '" . $irak['system'] . "' AND
                planet = '" . $irak['planet'] . "' AND
                planet_type = '1'", 'planets');

                $planet_start_count = doquery("SELECT * FROM {{table}} WHERE
                galaxy = '" . $irak['galaxy'] . "' AND
                system = '" . $irak['system'] . "' AND
                planet = '" . $irak['planet'] . "' AND
                planet_type = '1'", 'planets', true);

                $user_planet = doquery("SELECT * FROM {{table}} WHERE
                galaxy = '" . $irak['galaxy_angreifer'] . "' AND
                system = '" . $irak['system_angreifer'] . "' AND
                planet = '" . $irak['planet_angreifer'] . "' AND
                planet_type = '1'", 'planets', true);

                if ($planet_start_count[0] == 1) {
                    $planet = mysql_fetch_array($planet_start);
                }

                $fpage[$irak['zeit']] .= "<tr><th><div id=\"bxxfs$i\" class=\"z\"></div><font color=\"lime\">" . gmdate("H:i:s", $irak['zeit'] + 1 * 60 * 60) . "</font> </th><th colspan=\"3\"><font color=\"#0099FF\">Une attaque de missiles (" . $irak['anzahl'] . ") de " . $user_planet['name'] . " ";
                $fpage[$irak['zeit']] .= '<a href="galaxy.php?mode=3&galaxy=' . $irak["galaxy_angreifer"] . '&system=' . $irak["system_angreifer"] . '&planet=' . $irak["planet_angreifer"] . '">[' . $irak["galaxy_angreifer"] . ':' . $irak["system_angreifer"] . ':' . $irak["planet_angreifer"] . ']</a>';
                $fpage[$irak['zeit']] .= ' arrive sur la plan&egrave;te' . $planet["name"] . ' ';
                $fpage[$irak['zeit']] .= '<a href="galaxy.php?mode=3&galaxy=' . $irak["galaxy"] . '&system=' . $irak["system"] . '&planet=' . $irak["planet"] . '">[' . $irak["galaxy"] . ':' . $irak["system"] . ':' . $irak["planet"] . ']</a>';
                $fpage[$irak['zeit']] .= '</font>';
                $fpage[$irak['zeit']] .= InsertJavaScriptChronoApplet ( "fm", $Record, $time, false );
                $fpage[$irak['zeit']] .= "</th>";
            }
        }

        // -----------------------------------------------------------------------------------------------

        $parse                         = $lang;

        // -----------------------------------------------------------------------------------------------
        // News Frame ...
        // External Chat Frame ...
        // Banner ADS Google (meme si je suis contre cela)
        if ($game_config['OverviewNewsFrame'] == '1') {
            $parse['NewsFrame']          = "<tr><th>". $lang['ov_news_title'] ."</th><th colspan=\"3\">". stripslashes($game_config['OverviewNewsText']) ."</th></tr>";
        }
        if ($game_config['OverviewExternChat'] == '1') {
            $parse['ExternalTchatFrame'] = "<tr><th colspan=\"4\">". stripslashes( $game_config['OverviewExternChatCmd'] ) ."</th></tr>";
        }
        if ($game_config['OverviewClickBanner'] != '') {
            $parse['ClickBanner'] = stripslashes( $game_config['OverviewClickBanner'] );
        }

        // --- Gestion de l'affichage d'une lune ---------------------------------------------------------
        if ($planetrow['galaxy'] == $lunarow['galaxy'] && $planetrow['system'] == $lunarow['system'] && $planetrow['planet'] == $lunarow['lunapos'] && $planetrow['planet_type'] != 3) {
            $lune = doquery("SELECT * FROM {{table}} WHERE galaxy={$lunarow['galaxy']} AND system={$lunarow['system']} AND planet={$lunarow['lunapos']} AND planet_type='3'", 'planets', true);
            $parse['moon_img'] = "<a href=\"?cp={$lune['id']}&re=0\" title=\"{$UserPlanet['name']}\"><img src=\"{$dpath}planeten/{$lunarow['image']}.jpg\" height=\"50\" width=\"50\"></a>";
            $parse['moon'] = $lunarow['name'];
        } else {
            $parse['moon_img'] = "";
            $parse['moon'] = "";
        }
        // Moon END

        $parse['planet_name']          = $planetrow['name'];
        $parse['planet_diameter']      = pretty_number($planetrow['diameter']);
        $parse['planet_field_current'] = $planetrow['field_current'];
        $parse['planet_field_max']     = CalculateMaxPlanetFields($planetrow);
        $parse['planet_temp_min']      = $planetrow['temp_min'];
        $parse['planet_temp_max']      = $planetrow['temp_max'];
        $parse['galaxy_galaxy']        = $planetrow['galaxy'];
        $parse['galaxy_planet']        = $planetrow['planet'];
        $parse['galaxy_system']        = $planetrow['system'];
        $StatRecord = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $user['id'] ."';", 'statpoints', true);

        $parse['user_points']          = pretty_number( $StatRecord['build_points'] );
        $parse['user_fleet']           = pretty_number( $StatRecord['fleet_points'] );
        $parse['player_points_tech']   = pretty_number( $StatRecord['tech_points'] );
        $parse['total_points']         = pretty_number( $StatRecord['total_points'] );;

        $parse['user_rank']            = $StatRecord['total_rank'];
        $parse['user_username']        = $user['username'];

        if (isset($fpage) && count($fpage) > 0) {
            ksort($fpage);
            foreach ($fpage as $time => $content) {
                $flotten .= $content . "\n";
            }
        }

        $parse['fleet_list']  = $flotten;
        $parse['energy_used'] = $planetrow["energy_max"] - $planetrow["energy_used"];

        $parse['AccountStatusMessage']  = $AccountStatusMessage;
        $parse['Have_new_message']      = $Have_new_message;
        $parse['Have_new_level_mineur'] = $HaveNewLevelMineur;
        $parse['time']                  = date("D M d H:i:s");
        $parse['planet_image']          = $planetrow['image'];
        $parse['anothers_planets']      = $AllPlanets;

        $parse['metal_debris']          = pretty_number($galaxyrow['metal']);
        $parse['crystal_debris']        = pretty_number($galaxyrow['crystal']);
        if (($galaxyrow['metal'] != 0 || $galaxyrow['crystal'] != 0) && $planetrow[$resource[209]] != 0) {
            $parse['get_link'] = " (<a href=\"quickfleet.php?mode=8&g=".$galaxyrow['galaxy']."&s=".$galaxyrow['system']."&p=".$galaxyrow['planet']."&t=2\">". $lang['type_mission'][8] ."</a>)";
        }

        if ( $planetrow['b_building'] != 0 ) {
            UpdatePlanetBatimentQueueList ( $planetrow, $user );
            if ( $planetrow['b_building'] != 0 ) {
                $BuildQueue = explode (";", $planetrow['b_building_id']);
                $CurrBuild  = explode (",", $BuildQueue[0]);
                $RestTime   = $planetrow['b_building'] - time();
                $PlanetID   = $planetrow['id'];
                $Build  = InsertBuildListScript ( "overview" );
                $Build .= $lang['tech'][$CurrBuild[0]] .' ('. ($CurrBuild[1]) .')';
                $Build .= "<br /><div id=\"blc\" class=\"z\">". pretty_time( $RestTime ) ."</div>";
                $Build .= "\n<script language=\"JavaScript\">";
                $Build .= "\n    pp = \"". $RestTime ."\";\n";  // temps necessaire (a compter de maintenant et sans ajouter time() )
                $Build .= "\n    pk = \"". 1 ."\";\n";          // id index (dans la liste de construction)
                $Build .= "\n    pm = \"cancel\";\n";           // mot de controle
                $Build .= "\n    pl = \"". $PlanetID ."\";\n";  // id planete
                $Build .= "\n    t();\n";
                $Build .= "\n</script>\n";

                $parse['building'] = $Build;
            } else {
                $parse['building'] = $lang['Free'];
            }
        } else {
            $parse['building'] = $lang['Free'];
        }

        // Calculate percentage of planet development
        $parse['case_pourcentage'] = floor($planetrow["field_current"] / CalculateMaxPlanetFields($planetrow) * 100) . '%';
        // Barre de remplissage
        $parse['case_barre'] = floor($planetrow["field_current"] / CalculateMaxPlanetFields($planetrow) * 100) * 2.5;
        // Color the progressbar
        if ($parse['case_barre'] > (100 * 2.5)) {
            $parse['case_barre'] = 250;
            $parse['case_barre_barcolor'] = '#C00000';
        } elseif ($parse['case_barre'] > (80 * 2.5)) {
            $parse['case_barre_barcolor'] = '#C0C000';
        } else {
            $parse['case_barre_barcolor'] = '#00C000';
        }

        //Mode Améliorations
        $parse['xpminier']= $user['xpminier'];
        $parse['xpraid']= $user['xpraid'];
        $parse['lvl_minier'] = $user['lvl_minier'];
        $parse['lvl_raid'] = $user['lvl_raid'];

        $LvlMinier = $user['lvl_minier'];
        $LvlRaid = $user['lvl_raid'];

        $parse['lvl_up_minier'] = $LvlMinier * 50;
        $parse['lvl_up_raid']   = $LvlRaid * 10;

        // Count online users
        $OnlineUsers = doquery("SELECT COUNT(*) FROM {{table}} WHERE onlinetime>='".(time()-15*60)."'",'users', 'true');
        $parse['NumberMembersOnline'] = $OnlineUsers[0];

        $count = doquery('SELECT COUNT(*) FROM {{table}}', 'users', true);
        $parse['users_amount'] = $count[0];

        display(parsetemplate(gettemplate('overview_body'), $parse), $lang['Overview']);
        break;
}

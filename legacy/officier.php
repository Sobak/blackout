<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

function ShowOfficierPage (&$CurrentUser)
{
    global $lang, $resource, $reslist;

    includeLang('officier');

    // Verify that player's officer points are not negative
    if ($CurrentUser['rpg_points'] < 0) {
        doquery("UPDATE {{table}} SET `rpg_points` = '0' WHERE `id` = '". $CurrentUser['id'] ."';", 'users');
    }

    // Recruit the officer
    if ($_GET['mode'] == 2) {
        if ($CurrentUser['rpg_points'] > 0) {
            $Selected    = $_GET['offi'];
            if ( in_array($Selected, $reslist['officier']) ) {
                $Result = IsOfficierAccessible ( $CurrentUser, $Selected );
                if ( $Result == 1 ) {
                    $CurrentUser[$resource[$Selected]] += 1;
                    $CurrentUser['rpg_points']         -= 1;
                    if       ($Selected == 610) {
                        $CurrentUser['spy_tech']      += 5;
                    } elseif ($Selected == 611) {
                        $CurrentUser['computer_tech'] += 3;
                    }

                    $QryUpdateUser  = "UPDATE {{table}} SET ";
                    $QryUpdateUser .= "`rpg_points` = '". $CurrentUser['rpg_points'] ."', ";
                    $QryUpdateUser .= "`spy_tech` = '". $CurrentUser['spy_tech'] ."', ";
                    $QryUpdateUser .= "`computer_tech` = '". $CurrentUser['computer_tech'] ."', ";
                    $QryUpdateUser .= "`".$resource[$Selected]."` = '". $CurrentUser[$resource[$Selected]] ."' ";
                    $QryUpdateUser .= "WHERE ";
                    $QryUpdateUser .= "`id` = '". $CurrentUser['id'] ."';";
                    doquery( $QryUpdateUser, 'users' );
                    $Message = $lang['OffiRecrute'];
                } elseif ( $Result == -1 ) {
                    $Message = $lang['Maxlvl'];
                } elseif ( $Result == 0 ) {
                    $Message = $lang['Noob'];
                }
            }
        } else {
            $Message = $lang['NoPoints'];
        }

        $page = message_simple($Message, $lang['Officiers']);
    } else {
        // Show officers list
        $PageTPL = gettemplate('officier_body');
        $RowsTPL = gettemplate('officier_rows');
        $parse['off_points']   = $lang['off_points'];
        $parse['alv_points']   = $CurrentUser['rpg_points'];
        $parse['disp_off_tbl'] = "";
        for ($Officier = 601; $Officier <= 615; $Officier++) {
            $Result = IsOfficierAccessible($CurrentUser, $Officier);
            if ( $Result != 0 ) {
                $bloc['off_id']       = $Officier;
                $bloc['off_tx_lvl']   = $lang['off_tx_lvl'];
                $bloc['off_lvl']      = $CurrentUser[$resource[$Officier]];
                $bloc['off_desc']     = $lang['res']['descriptions'][$Officier];
                if ($Result == 1) {
                    $bloc['off_link'] = '<a href="officier.php?mode=2&offi='.$Officier.'"><font color="#00ff00">'. $lang['link'][$Officier].'</font>';
                } else {
                    $bloc['off_link'] = $lang['Maxlvl'];
                }
                $parse['disp_off_tbl'] .= parsetemplate($RowsTPL, $bloc);
            }
        }

        $page = parsetemplate($PageTPL, $parse);
    }

    return $page;
}

$page = ShowOfficierPage ( $user );
display($page, $lang['Officiers']);

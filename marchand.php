<?php

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

function ModuleMarchand(&$CurrentPlanet)
{
    global $lang;

    includeLang('marchand');

    $parse   = $lang;

    if ($_POST['ress'] != '') {
        $Error   = false;
        switch ($_POST['ress']) {
            case 'metal':
                $Necessaire   = (($_POST['cristal'] * 2) + ($_POST['deut'] * 4));
                if (($_POST['cristal'] < 0) || ($_POST['deut'] < 0)){
                    $Message = "Failed";
                    $Error   = true;
                } elseif ($CurrentPlanet['metal'] > $Necessaire) {
                    $CurrentPlanet['metal'] -= $Necessaire;
                } else {
                    $Message = $lang['mod_ma_noten'] ." ". $lang['Metal'];
                    $Error   = true;
                }
                break;

            case 'cristal':
                $Necessaire   = (($_POST['metal'] * 0.5) + ($_POST['deut'] * 2));
                if(($_POST['metal'] < 0) || ($_POST['deut'] < 0)){
                    $Message = "Failed";
                    $Error   = true;
                } elseif ($CurrentPlanet['crystal'] > $Necessaire) {
                    $CurrentPlanet['crystal'] -= $Necessaire;
                } else {
                    $Message = $lang['mod_ma_noten'] ." ". $lang['Crystal'];
                    $Error   = true;
                }
                break;

            case 'deuterium':
                $Necessaire   = (($_POST['metal'] * 0.25) + ($_POST['cristal'] * 0.5));
                if(($_POST['metal'] < 0) || ($_POST['cristal'] < 0)){
                    $Message = "Failed";
                    $Error   = true;
                } elseif ($CurrentPlanet['deuterium'] > $Necessaire) {
                    $CurrentPlanet['deuterium'] -= $Necessaire;
                } else {
                    $Message = $lang['mod_ma_noten'] ." ". $lang['Deuterium'];
                    $Error   = true;
                }
                break;
        }
        if ($Error == false) {
            $CurrentPlanet['metal']     += $_POST['metal'];
            $CurrentPlanet['crystal']   += $_POST['cristal'];
            $CurrentPlanet['deuterium'] += $_POST['deut'];

            $QryUpdatePlanet  = "UPDATE {{table}} SET ";
            $QryUpdatePlanet .= "`metal` = '".     $CurrentPlanet['metal']     ."', ";
            $QryUpdatePlanet .= "`crystal` = '".   $CurrentPlanet['crystal']   ."', ";
            $QryUpdatePlanet .= "`deuterium` = '". $CurrentPlanet['deuterium'] ."' ";
            $QryUpdatePlanet .= "WHERE ";
            $QryUpdatePlanet .= "`id` = '".        $CurrentPlanet['id']        ."';";
            doquery ( $QryUpdatePlanet , 'planets');
            $Message = $lang['mod_ma_done'];
        }

        $MessageTitle = $Error ? $lang['sys_error'] : $lang['sys_success'];
    } else {
        if ($_POST['action'] != 2) {
            $PageTPL = gettemplate('marchand_main');
        } else {
            $parse['mod_ma_res']   = "1";
            switch ($_POST['choix']) {
                case 'metal':
                    $PageTPL = gettemplate('marchand_metal');
                    $parse['mod_ma_res_a'] = "2";
                    $parse['mod_ma_res_b'] = "4";
                    break;
                case 'cristal':
                    $PageTPL = gettemplate('marchand_cristal');
                    $parse['mod_ma_res_a'] = "0.5";
                    $parse['mod_ma_res_b'] = "2";
                    break;
                case 'deut':
                    $PageTPL = gettemplate('marchand_deuterium');
                    $parse['mod_ma_res_a'] = "0.25";
                    $parse['mod_ma_res_b'] = "0.5";
                    break;
            }
        }
    }

    if ($Message && $MessageTitle) {
        return message_simple($Message, $MessageTitle);
    }

    return parsetemplate($PageTPL, $parse);
}

$content = ModuleMarchand($planetrow);
display($content, $lang['marchand_title']);

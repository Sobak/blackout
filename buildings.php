<?php

/**
 * buildings.php
 *
 * @version 1.3
 * @copyright 2008 by Chlorel for XNova
 */

define('INSIDE'  , true);

$ugamela_root_path = './';
include($ugamela_root_path . 'common.php');

includeLang('buildings');

// Mise a jour de la liste de construction si necessaire
UpdatePlanetBatimentQueueList ( $planetrow, $user );
$IsWorking = HandleTechnologieBuild ( $planetrow, $user );

switch ($_GET['mode']) {
    case 'fleet':
        // --------------------------------------------------------------------------------------------------
        FleetBuildingPage ( $planetrow, $user );
        break;

    case 'research':
        // --------------------------------------------------------------------------------------------------
        ResearchBuildingPage ( $planetrow, $user, $IsWorking['OnWork'], $IsWorking['WorkOn'] );
        break;

    case 'defense':
        // --------------------------------------------------------------------------------------------------
        DefensesBuildingPage ( $planetrow, $user );
        break;

    default:
        // --------------------------------------------------------------------------------------------------
        BatimentBuildingPage ( $planetrow, $user );
        break;
}

// -----------------------------------------------------------------------------------------------------------
// History version
// 1.0 - Nettoyage modularisation
// 1.1 - Mise au point, mise en fonction pour lin�arisation du fonctionnement
// 1.2 - Liste de construction batiments
?>
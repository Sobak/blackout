<?php
/**
 *
 *
 * @version 1
 * @copyright 2008 By Chlorel for XNova
 */

// Fonctions deja 'au propre'
include($ugamela_root_path . 'includes/functions/FlyingFleetHandler.php');
include($ugamela_root_path . 'includes/functions/MissionCaseAttack.php');
include($ugamela_root_path . 'includes/functions/MissionCaseStay.php');
include($ugamela_root_path . 'includes/functions/MissionCaseStayAlly.php');
include($ugamela_root_path . 'includes/functions/MissionCaseTransport.php');
include($ugamela_root_path . 'includes/functions/MissionCaseSpy.php');
include($ugamela_root_path . 'includes/functions/MissionCaseRecycling.php');
include($ugamela_root_path . 'includes/functions/MissionCaseDestruction.php');
include($ugamela_root_path . 'includes/functions/MissionCaseColonisation.php');
include($ugamela_root_path . 'includes/functions/MissionCaseExpedition.php');
include($ugamela_root_path . 'includes/functions/SendSimpleMessage.php');
include($ugamela_root_path . 'includes/functions/SpyTarget.php');
include($ugamela_root_path . 'includes/functions/RestoreFleetToPlanet.php');
include($ugamela_root_path . 'includes/functions/StoreGoodsToPlanet.php');
include($ugamela_root_path . 'includes/functions/CheckPlanetBuildingQueue.php');
include($ugamela_root_path . 'includes/functions/CheckPlanetUsedFields.php');
include($ugamela_root_path . 'includes/functions/CreateOneMoonRecord.php');
include($ugamela_root_path . 'includes/functions/CreateOnePlanetRecord.php');
include($ugamela_root_path . 'includes/functions/InsertJavaScriptChronoApplet.php');
include($ugamela_root_path . 'includes/functions/IsTechnologieAccessible.php');
include($ugamela_root_path . 'includes/functions/GetBuildingTime.php');
include($ugamela_root_path . 'includes/functions/GetRestPrice.php');
include($ugamela_root_path . 'includes/functions/GetElementPrice.php');
include($ugamela_root_path . 'includes/functions/GetBuildingPrice.php');
include($ugamela_root_path . 'includes/functions/IsElementBuyable.php');
include($ugamela_root_path . 'includes/functions/CheckCookies.php');
include($ugamela_root_path . 'includes/functions/ChekUser.php');
include($ugamela_root_path . 'includes/functions/InsertGalaxyScripts.php');
include($ugamela_root_path . 'includes/functions/GalaxyCheckFunctions.php');
include($ugamela_root_path . 'includes/functions/ShowGalaxyRows.php');
include($ugamela_root_path . 'includes/functions/GetPhalanxRange.php');
include($ugamela_root_path . 'includes/functions/GetMissileRange.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowPos.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowPlanet.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowPlanetName.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowMoon.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowDebris.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowUser.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowava.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowAlly.php');
include($ugamela_root_path . 'includes/functions/GalaxyRowActions.php');
include($ugamela_root_path . 'includes/functions/ShowGalaxySelector.php');
include($ugamela_root_path . 'includes/functions/ShowGalaxyMISelector.php');
include($ugamela_root_path . 'includes/functions/ShowGalaxyTitles.php');
include($ugamela_root_path . 'includes/functions/GalaxyLegendPopup.php');
include($ugamela_root_path . 'includes/functions/ShowGalaxyFooter.php');
include($ugamela_root_path . 'includes/functions/GetMaxConstructibleElements.php');
include($ugamela_root_path . 'includes/functions/GetElementRessources.php');
include($ugamela_root_path . 'includes/functions/ElementBuildListBox.php');
include($ugamela_root_path . 'includes/functions/ElementBuildListQueue.php');
include($ugamela_root_path . 'includes/functions/FleetBuildingPage.php');
include($ugamela_root_path . 'includes/functions/DefensesBuildingPage.php');
include($ugamela_root_path . 'includes/functions/ResearchBuildingPage.php');
include($ugamela_root_path . 'includes/functions/BatimentBuildingPage.php');
include($ugamela_root_path . 'includes/functions/CheckLabSettingsInQueue.php');
include($ugamela_root_path . 'includes/functions/InsertBuildListScript.php');
include($ugamela_root_path . 'includes/functions/AddBuildingToQueue.php');
include($ugamela_root_path . 'includes/functions/ShowBuildingQueue.php');
include($ugamela_root_path . 'includes/functions/HandleTechnologieBuild.php');
include($ugamela_root_path . 'includes/functions/BuildingSavePlanetRecord.php');
include($ugamela_root_path . 'includes/functions/BuildingSaveUserRecord.php');
include($ugamela_root_path . 'includes/functions/RemoveBuildingFromQueue.php');
include($ugamela_root_path . 'includes/functions/CancelBuildingFromQueue.php');
include($ugamela_root_path . 'includes/functions/SetNextQueueElementOnTop.php');
include($ugamela_root_path . 'includes/functions/ShowTopNavigationBar.php');
include($ugamela_root_path . 'includes/functions/SetSelectedPlanet.php');
include($ugamela_root_path . 'includes/functions/MessageForm.php');
include($ugamela_root_path . 'includes/functions/PlanetResourceUpdate.php');
include($ugamela_root_path . 'includes/functions/BuildFlyingFleetTable.php');
include($ugamela_root_path . 'includes/functions/SendNewPassword.php');
include($ugamela_root_path . 'includes/functions/HandleElementBuildingQueue.php');
include($ugamela_root_path . 'includes/functions/UpdatePlanetBatimentQueueList.php');
include($ugamela_root_path . 'includes/functions/IsOfficierAccessible.php');
include($ugamela_root_path . 'includes/functions/CheckInputStrings.php');
include($ugamela_root_path . 'includes/functions/MipCombatEngine.php');
include($ugamela_root_path . 'includes/functions/DeleteSelectedUser.php');
include($ugamela_root_path . 'includes/functions/SortUserPlanets.php');
include($ugamela_root_path . 'includes/functions/BuildFleetEventTable.php');
include($ugamela_root_path . 'includes/functions/BuildRessourcePage.php');

?>
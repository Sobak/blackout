<?php

/**
 * HandleTechnologieBuild.php
 *
 * @version 1.1
 * @copyright 2008 by Chlorel for XNova
 */

// -----------------------------------------------------------------------------------------------------------
// Teste s'il y a une technologie en cours de realisation
// Paramatres :
// $CurrentPlanet -> Planete sur laquelle on entre dans le laboratoire
// $CurrentUser   -> Joueur
// Reponse :
// Tableau de 2 elements
//     ['OnWork'] -> Boolean .. Vrai ou Faux
//     ['WorkOn'] -> Table de l'enregistrement de la planete sur laquelle s'effectue la techno
function HandleTechnologieBuild ( &$CurrentPlanet, &$CurrentUser ) {
	global $resource;

	if ($CurrentUser['b_tech_planet'] != 0) {
		// Y a une technologie en cours sur une de mes colonies
		if ($CurrentUser['b_tech_planet'] != $CurrentPlanet['id']) {
			// Et ce n'est pas sur celle ci !!
			$WorkingPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '". $CurrentUser['b_tech_planet'] ."';", 'planets', true);
		}

		if ($WorkingPlanet) {
			$ThePlanet = $WorkingPlanet;
		} else {
			$ThePlanet = $CurrentPlanet;
		}

		if ($ThePlanet['b_tech']    <= time() &&
			$ThePlanet['b_tech_id'] != 0) {
			// La recherche en cours est terminée ...
			$CurrentUser[$resource[$ThePlanet['b_tech_id']]]++;
			// Mise a jour de la planete sur laquelle la technologie a été recherchée
			$QryUpdatePlanet  = "UPDATE {{table}} SET ";
			$QryUpdatePlanet .= "`b_tech` = '0', ";
			$QryUpdatePlanet .= "`b_tech_id` = '0' ";
			$QryUpdatePlanet .= "WHERE ";
			$QryUpdatePlanet .= "`id` = '". $ThePlanet['id'] ."';";
			doquery( $QryUpdatePlanet, 'planets');

			// Mes a jour de la techno sur l'enregistrement Utilisateur
			// Et tant qu'a faire des stats points
			$QryUpdateUser    = "UPDATE {{table}} SET ";
			$QryUpdateUser   .= "`".$resource[$ThePlanet['b_tech_id']]."` = '". $CurrentUser[$resource[$ThePlanet['b_tech_id']]] ."', ";
			$QryUpdateUser   .= "`b_tech_planet` = '0' ";
			$QryUpdateUser   .= "WHERE ";
			$QryUpdateUser   .= "`id` = '". $CurrentUser['id'] ."';";
			doquery( $QryUpdateUser, 'users');
			$ThePlanet["b_tech_id"] = 0;
			if (isset($WorkingPlanet)) {
				$WorkingPlanet = $ThePlanet;
			} else {
				$CurrentPlanet = $ThePlanet;
			}
			$Result['WorkOn'] = "";
			$Result['OnWork'] = false;

		} elseif ($ThePlanet["b_tech_id"] == 0) {
			// Il n'y a rien a l'ouest ...
			// Pas de Technologie en cours devait y avoir un bug lors de la derniere connexion
			// On met l'enregistrement informant d'une techno en cours de recherche a jours
			doquery("UPDATE {{table}} SET `b_tech_planet` = '0'  WHERE `id` = '". $CurrentUser['id'] ."';", 'users');
			$Result['WorkOn'] = "";
			$Result['OnWork'] = false;

		} else {
			// Bin on bosse toujours ici ... Alors ne nous derangez pas !!!
			$Result['WorkOn'] = $ThePlanet;
			$Result['OnWork'] = true;
		}
	} else {
		$Result['WorkOn'] = "";
		$Result['OnWork'] = false;
	}

	return $Result;
}

// History revision
// 1.0 - mise en forme modularisation version initiale
// 1.1 - Correction retour de fonction (retourne un tableau a la place d'un flag)
?>
<?php

/**
 * Removes too big queues.
 *
 * This function fetches over the planets and clears the hangar queues
 * with too many elements in them.
 *
 * @return int Number of cleared queues
 */
function ElementQueueFixer()
{
    $deletedQueues = 0;

    $querySelectPlanet  = "SELECT `id`, `id_owner`, `b_hangar`, `b_hangar_id` ";
    $querySelectPlanet .= "FROM {{table}} ";
    $querySelectPlanet .= "WHERE ";
    $querySelectPlanet .= "`b_hangar_id` != '0';";
    $affectedPlanets = doquery ($querySelectPlanet, 'planets');

    while ($planet = mysql_fetch_assoc($affectedPlanets)) {
        $hangarQueue = explode(";", $planet['b_hangar_id']);
        $deleteQueue = false;

        if (count($hangarQueue)) {
            for ($queue = 0; $queue < count($hangarQueue); $queue++) {
                $inQueue = explode (",", $hangarQueue[$queue]);
                if ($inQueue[1] > MAX_FLEET_OR_DEFS_PER_ROW) {
                    $deleteQueue = true;
                }
            }
        }

        if ($deleteQueue) {
            $QryUpdatePlanet  = "UPDATE {{table}} ";
            $QryUpdatePlanet .= "SET ";
            $QryUpdatePlanet .= "`b_hangar` = '0', ";
            $QryUpdatePlanet .= "`b_hangar_id` = '0' ";
            $QryUpdatePlanet .= "WHERE ";
            $QryUpdatePlanet .= "`id` = '".$planet['id']."'";
            doquery ($QryUpdatePlanet, 'planets');
            ++$deletedQueues;
        }
    }

    return $deletedQueues;
}

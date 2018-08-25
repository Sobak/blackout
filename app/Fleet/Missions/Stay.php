<?php

namespace App\Fleet\Missions;

use App\Models\Fleet;
use App\Models\Planet;
use App\Services\Fleets;
use App\Services\Messages;

class Stay extends AbstractMission
{
    protected function arrival(Fleet $fleet, Fleets $service)
    {
        $target = Planet::where('galaxy', $fleet->fleet_end_galaxy)
                        ->where('system', $fleet->fleet_end_system)
                        ->where('planet', $fleet->fleet_end_planet)
                        ->where('planet_type', $fleet->fleet_end_type)
                        ->first();

        $targetCoords = coordinates($target);
        $targetGoods = sprintf(
            trans('fleets.messages.stay.goods'),
            trans('resources.metal'), pretty_number($fleet->fleet_resource_metal),
            trans('resources.crystal'), pretty_number($fleet->fleet_resource_crystal),
            trans('resources.deuterium'), pretty_number($fleet->fleet_resource_deuterium)
        );

        $targetMessage = trans('fleets.messages.stay.start') ."<a href=\"galaxy.php?mode=3&galaxy=". $fleet->fleet_end_galaxy ."&system=". $fleet->fleet_end_system ."\">";
        $targetMessage .= $targetCoords . "</a>". trans('fleets.messages.stay.end') ."<br />". $targetGoods;

        Messages::send($target->id_owner, 0, trans('fleets.messages.sender'), 5, trans('fleets.messages.stay.subject'), $targetMessage, $fleet->fleet_start_time);

        $service->restoreFleetToPlanet($fleet, false);

        $fleet->delete();
    }

    protected function return(Fleet $fleet, Fleets $service)
    {
        $targetCoords = sprintf(trans('planet.coords'), $fleet->fleet_start_galaxy, $fleet->fleet_start_system, $fleet->fleet_start_planet);
        $targetGoods = sprintf(
            trans('fleets.messages.stay.goods'),
            trans('resources.metal'), pretty_number($fleet->fleet_resource_metal),
            trans('resources.crystal'), pretty_number($fleet->fleet_resource_crystal),
            trans('resources.deuterium'), pretty_number($fleet->fleet_resource_deuterium)
        );

        $targetMessage = trans('fleets.messages.stay.back') ."<a href=\"galaxy.php?mode=3&galaxy=". $fleet->fleet_start_galaxy ."&system=". $fleet->fleet_start_system ."\">";
        $targetMessage .= $targetCoords . "</a>". trans('fleets.messages.stay.back_end') ."<br />". $targetGoods;

        Messages::send($fleet->fleet_owner, 0, trans('fleets.messages.sender'), 5, trans('fleets.messages.subject_back'), $targetMessage, $fleet->fleet_end_time);

        $service->restoreFleetToPlanet($fleet, true);

        $fleet->delete();
    }
}

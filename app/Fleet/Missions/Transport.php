<?php

namespace App\Fleet\Missions;

use App\Models\Fleet;
use App\Models\Planet;
use App\Services\Fleets;
use App\Services\Messages;

class Transport extends AbstractMission
{
    protected function arrival(Fleet $fleet, Fleets $service)
    {
        $sender = Planet::where('galaxy', $fleet->fleet_start_galaxy)
                        ->where('system', $fleet->fleet_start_system)
                        ->where('planet', $fleet->fleet_start_planet)
                        ->where('planet_type', $fleet->fleet_start_type)
                        ->first();

        $target = Planet::where('galaxy', $fleet->fleet_end_galaxy)
                        ->where('system', $fleet->fleet_end_system)
                        ->where('planet', $fleet->fleet_end_planet)
                        ->where('planet_type', $fleet->fleet_end_type)
                        ->first();

        $service->storeGoodsToPlanet($fleet, false);

        $message = sprintf(
            trans('fleets.messages.transport.owner'),
            $target->name, GetTargetAdressLink($fleet, ''),
            $fleet->fleet_resource_metal, trans('resources.metal'),
            $fleet->fleet_resource_crystal, trans('resources.crystal'),
            $fleet->fleet_resource_deuterium, trans('resources.deuterium')
        );

        Messages::send($sender->id_owner, 0, trans('fleets.messages.sender_tower'), 5, trans('fleets.messages.transport.subject'), $message, $fleet->fleet_start_time);

        if ($target->id_owner != $sender->id_owner) {
            $message = sprintf(
                trans('fleets.messages.transport.user'),
                $sender->name, GetStartAdressLink($fleet, ''),
                $target->name, GetTargetAdressLink($fleet, ''),
                $fleet->fleet_resource_metal, trans('resources.metal'),
                $fleet->fleet_resource_crystal, trans('resources.crystal'),
                $fleet->fleet_resource_deuterium, trans('resources.deuterium')
            );

            Messages::send($target->id_owner, 0, trans('fleets.messages.sender_tower'), 5, trans('fleets.messages.transport.subject'), $message, $fleet->fleet_start_time);
        }

        $fleet->fleet_resource_metal = 0;
        $fleet->fleet_resource_crystal = 0;
        $fleet->fleet_resource_deuterium = 0;
        $fleet->fleet_mess = 1;

        $fleet->save();
    }

    protected function return(Fleet $fleet, Fleets $service)
    {
        $sender = Planet::where('galaxy', $fleet->fleet_start_galaxy)
                        ->where('system', $fleet->fleet_start_system)
                        ->where('planet', $fleet->fleet_start_planet)
                        ->where('planet_type', $fleet->fleet_start_type)
                        ->first();

        $message = sprintf(
            trans('fleets.messages.transport.back'),
            $sender->name,
            GetStartAdressLink($fleet, '')
        );

        Messages::send($fleet->fleet_owner, 0, trans('fleets.messages.sender_tower'), 5, trans('fleets.messages.subject_back'), $message, $fleet->fleet_end_time);

        $service->restoreFleetToPlanet($fleet, true);

        $fleet->delete();
    }
}

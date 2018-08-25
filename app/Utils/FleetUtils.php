<?php

namespace App\Utils;

use App\Models\Fleet;
use App\Models\Planet;

class FleetUtils
{
    public static function restoreFleetToPlanet(Fleet $fleet, $start = true)
    {
        $resource = ConstantsUtils::$resourcesMap;

        if ($start) {
            $planet = Planet::where('galaxy', $fleet->fleet_start_galaxy)
                            ->where('system', $fleet->fleet_start_system)
                            ->where('planet', $fleet->fleet_start_planet)
                            ->where('planet_type', $fleet->fleet_start_type)
                            ->first();
        } else {
            $planet = Planet::where('galaxy', $fleet->fleet_start_galaxy)
                            ->where('system', $fleet->fleet_end_system)
                            ->where('planet', $fleet->fleet_end_planet)
                            ->where('planet_type', $fleet->fleet_end_type)
                            ->first();
        }

        foreach (explode(';', $fleet->fleet_array) as $item => $group) {
            if ($group != '') {
                $class = explode(',', $group);

                $planet[$resource[$class[0]]] = $planet[$resource[$class[0]]] + $planet[$resource[$class[1]]];
            }
        }

        $planet->metal = $planet->metal + $fleet->fleet_resource_metal;
        $planet->crystal = $planet->crystal + $fleet->fleet_resource_crystal;
        $planet->deuterium = $planet->deuterium + $fleet->fleet_resource_deuterium;

        $planet->save();
    }

    public static function storeGoodsToPlanet(Fleet $fleet, $start = false)
    {
        if ($start) {
            $planet = Planet::where('galaxy', $fleet->fleet_start_galaxy)
                            ->where('system', $fleet->fleet_start_system)
                            ->where('planet', $fleet->fleet_start_planet)
                            ->where('planet_type', $fleet->fleet_start_type)
                            ->first();
        } else {
            $planet = Planet::where('galaxy', $fleet->fleet_start_galaxy)
                            ->where('system', $fleet->fleet_end_system)
                            ->where('planet', $fleet->fleet_end_planet)
                            ->where('planet_type', $fleet->fleet_end_type)
                            ->first();
        }

        $planet->metal = $planet->metal + $fleet->fleet_resource_metal;
        $planet->crystal = $planet->crystal + $fleet->fleet_resource_crystal;
        $planet->deuterium = $planet->deuterium + $fleet->fleet_resource_deuterium;

        $planet->save();
    }
}

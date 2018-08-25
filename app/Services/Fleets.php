<?php

namespace App\Services;

use App\Fleet\Missions\AbstractMission;
use App\Fleet\Missions\Stay;
use App\Models\Fleet;
use App\Models\Planet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Fleets
{
    public function handleFlying()
    {
        $now = time();

        $fleets = Fleet::where('fleet_start_time', '<=', $now)->get();

        foreach ($fleets as $fleet) {
            $planet = [];
            $planet['galaxy'] = $fleet->fleet_start_galaxy;
            $planet['system'] = $fleet->fleet_start_system;
            $planet['planet'] = $fleet->fleet_start_planet;
            $planet['planet_type'] = $fleet->fleet_start_type;

            $this->handleFleet($planet);
        }

        $fleets = Fleet::where('fleet_end_time', '<=', $now)->get();

        foreach ($fleets as $fleet) {
            $planet = [];
            $planet['galaxy'] = $fleet->fleet_end_galaxy;
            $planet['system'] = $fleet->fleet_end_system;
            $planet['planet'] = $fleet->fleet_end_planet;
            $planet['planet_type'] = $fleet->fleet_end_type;

            $this->handleFleet($planet);
        }
    }

    public function restoreFleetToPlanet(Fleet $fleet, $start = true)
    {
        $resource = Constants::$resourcesMap;

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

    protected function handleFleet($planet)
    {
        $this->lockTables();

        $now = time();

        $fleets = Fleet::where(function (Builder $query) use ($planet) {
            $query->where('fleet_start_galaxy', $planet['galaxy'])
                ->where('fleet_start_system', $planet['system'])
                ->where('fleet_start_planet', $planet['planet'])
                ->where('fleet_start_type', $planet['planet_type']);
        })
            ->orWhere(function (Builder $query) use ($planet) {
                $query->where('fleet_end_galaxy', $planet['galaxy'])
                      ->where('fleet_end_system', $planet['system'])
                      ->where('fleet_end_planet', $planet['planet'])
                      ->where('fleet_end_type', $planet['planet_type']);
            })
            ->where(function (Builder $query) use ($now) {
                $query->where('fleet_start_time', '<', $now)
                    ->orWhere('fleet_end_time', '<', $now);
            })
            ->get();

        foreach ($fleets as $fleet) {
            switch ($fleet->fleet_mission) {
                case 1:
                    // Attack
                    break;

                case 2:
                    // Group attack
                    $fleet->delete();
                    break;

                case 3:
                    // Transport
                    break;

                case 4:
                    // Stay
                    $this->handleMission($fleet, Stay::class);
                    break;

                case 5:
                    // Stay at an ally
                    $fleet->delete();
                    //$this->handleMission($fleet, StayAtAlly::class);
                    break;

                case 6:
                    // Spy
                    break;

                case 7:
                    // Colonize
                    break;

                case 8:
                    // Recycle
                    break;

                case 9:
                    // Destroy? In XNova it does nothing
                    break;

                case 10:
                    // Missile attack? In XNova it does nothing
                    break;

                case 15:
                    // Expedition
                    break;

                default:
                    $fleet->delete();
            }
        }

        $this->unlockTables();
    }

    protected function handleMission(Fleet $fleet, $className)
    {
        if (is_subclass_of($className, AbstractMission::class) === false) {
            throw new \InvalidArgumentException('Mission handler must inherit from AbstractMission class');
        }

        /** @var AbstractMission $missionHandler */
        $missionHandler = new $className($fleet, $this);
        $missionHandler->handle();
    }

    protected function lockTables()
    {
        $tablePrefix = DB::getTablePrefix();

        DB::unprepared("
        LOCK TABLE
        {$tablePrefix}lunas WRITE,
        {$tablePrefix}rw WRITE,
        {$tablePrefix}errors WRITE,
        {$tablePrefix}messages WRITE,
        {$tablePrefix}fleets WRITE,
        {$tablePrefix}planets WRITE,
        {$tablePrefix}galaxy WRITE,
        {$tablePrefix}users WRITE
        ");
    }

    protected function unlockTables()
    {
        DB::unprepared('UNLOCK TABLES');
    }
}

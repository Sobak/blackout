<?php

namespace App\Services;

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
                    $this->missionAttack($fleet);
                    break;

                case 2:
                    // Group attack
                    $fleet->delete();
                    break;

                case 3:
                    // Transport
                    $this->missionTransport($fleet);
                    break;

                case 4:
                    // Stay
                    $this->missionStay($fleet);
                    break;

                case 5:
                    // Stay at an ally
                    $fleet->delete();
                    //$this->missionStayAlly($fleet);
                    break;

                case 6:
                    // Spy fleet
                    $this->missionSpy($fleet);
                    break;

                case 7:
                    // Colonize
                    $this->missionColonize($fleet);
                    break;

                case 8:
                    // Recycle
                    $this->missionRecycle($fleet);
                    break;

                case 9:
                    // Destroy? In XNova it does nothing
                    break;

                case 10:
                    // Missile attack? In XNova it does nothing
                    break;

                case 15:
                    // Expedition
                    $this->missionExpedition($fleet);
                    break;

                default:
                    $fleet->delete();
            }
        }

        $this->unlockTables();
    }

    protected function missionAttack(Fleet $fleet)
    {
        //
    }

    protected function missionColonize(Fleet $fleet)
    {
        //
    }

    protected function missionExpedition(Fleet $fleet)
    {
        //
    }

    protected function missionRecycle(Fleet $fleet)
    {
        //
    }

    protected function missionSpy(Fleet $fleet)
    {
        //
    }

    protected function missionStay(Fleet $fleet)
    {
        if ($fleet->fleet_mess == 0) {
            if ($fleet->fleet_start_time <= time()) {
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

                $this->restoreFleetToPlanet($fleet, false);

                $fleet->delete();
            }
        } else {
            if ($fleet->fleet_end_time <= time()) {
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

                $this->restoreFleetToPlanet($fleet, true);

                $fleet->delete();
            }
        }
    }

    protected function missionTransport(Fleet $fleet)
    {
        //
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

    protected function restoreFleetToPlanet(Fleet $fleet, $start = true)
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
}

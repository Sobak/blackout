<?php

namespace App\Services;

use App\Fleet\Missions\AbstractMission;
use App\Fleet\Missions\Stay;
use App\Fleet\Missions\Transport;
use App\Models\Fleet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class FleetService
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
                    break;

                case 2:
                    // Group attack
                    $fleet->delete();
                    break;

                case 3:
                    $this->handleMission($fleet, Transport::class);
                    break;

                case 4:
                    $this->handleMission($fleet, Stay::class);
                    break;

                case 5:
                    //$this->handleMission($fleet, StayAtAlly::class);
                    $fleet->delete();
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
        $missionHandler = new $className($fleet);
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

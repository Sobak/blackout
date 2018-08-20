<?php

namespace App\Services;

use App\Models\Fleet;
use Illuminate\Database\Query\Builder;
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
                    $this->destroyFleet($fleet);
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
                    $this->destroyFleet($fleet);
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
                    $this->destroyFleet($fleet);
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
        //
    }

    protected function missionTransport(Fleet $fleet)
    {
        //
    }

    protected function destroyFleet(Fleet $fleet)
    {
        $fleet->delete();
    }

    protected function lockTables()
    {
        $tablePrefix = DB::getTablePrefix();

        DB::statement("
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
        DB::statement('UNLOCK TABLES');
    }
}

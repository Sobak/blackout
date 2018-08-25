<?php

namespace App\Fleet\Missions;

use App\Models\Fleet;
use App\Services\FleetService;

abstract class AbstractMission
{
    /** @var Fleet */
    protected $fleet;

    /** @var FleetService */
    protected $service;

    public function __construct(Fleet $fleet, FleetService $service)
    {
        $this->fleet = $fleet;
        $this->service = $service;
    }

    public function handle()
    {
        if ($this->fleet->fleet_mess == 0 && $this->fleet->fleet_start_time <= time()) {
            $this->arrival($this->fleet, $this->service);
        } elseif ($this->fleet->fleet_mess == 1 && $this->fleet->fleet_end_time <= time()) {
            $this->return($this->fleet, $this->service);
        }
    }

    protected abstract function arrival(Fleet $fleet, FleetService $service);

    protected abstract function return(Fleet $fleet, FleetService $service);
}

<?php

namespace App\Fleet\Missions;

use App\Models\Fleet;
use App\Services\Fleets;

abstract class AbstractMission
{
    /** @var Fleet */
    protected $fleet;

    /** @var Fleets */
    protected $service;

    public function __construct(Fleet $fleet, Fleets $service)
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

    protected abstract function arrival(Fleet $fleet, Fleets $service);

    protected abstract function return(Fleet $fleet, Fleets $service);
}

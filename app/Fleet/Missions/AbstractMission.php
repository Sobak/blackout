<?php

namespace App\Fleet\Missions;

use App\Models\Fleet;

abstract class AbstractMission
{
    /** @var Fleet */
    protected $fleet;

    public function __construct(Fleet $fleet)
    {
        $this->fleet = $fleet;
    }

    public function handle()
    {
        if ($this->fleet->fleet_mess == 0 && $this->fleet->fleet_start_time <= time()) {
            $this->arrival($this->fleet);
        } elseif ($this->fleet->fleet_mess == 1 && $this->fleet->fleet_end_time <= time()) {
            $this->return($this->fleet);
        }
    }

    protected abstract function arrival(Fleet $fleet);

    protected abstract function return(Fleet $fleet);
}

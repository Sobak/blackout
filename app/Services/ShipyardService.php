<?php

namespace App\Services;

use App\Models\Planet;
use App\Models\User;
use App\Utils\QueueUtils;

class ShipyardService
{
    public function handleQueue(User $user, Planet $planet, $buildTime)
    {
        // Queue is empty
        if ($planet->b_hangar_id == 0) {
            return [];
        }

        $toBuild = $built = [];

        $planet->b_hangar += $buildTime;

        foreach (explode(';', $planet->b_hangar_id) as $node => $array) {
            if ($array != '') {
                $item = explode(',', $array);

                // Store element, level and build duration
                $toBuild[$node] = [$item[0], $item[1], QueueUtils::getBuildDuration($user, $planet, $item[0])];
            }
        }

        $planet->b_hangar_id = '';

        $finished = false;
        foreach ($toBuild as $node => $item) {
            if (!$finished) {
                $element = $item[0];
                $count = $item[1];
                $duration = $item[2];

                while ($planet->b_hangar >= $duration && !$finished) {
                    if ($count > 0) {
                        $planet->b_hangar -= $duration;
                        $built[$element]++;
                        $count--;

                        if ($count == 0) {
                            break;
                        }
                    } else {
                        $finished = true;
                        break;
                    }
                }
            }
            if ($count != 0) {
                $planet->b_hangar_id .= "$element,$count;";
            }
        }

        return $built;
    }
}

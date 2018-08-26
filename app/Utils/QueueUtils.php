<?php

namespace App\Utils;

use App\Models\Planet;
use App\Models\User;

class QueueUtils
{
    public static function getBuildDuration(User $user, Planet $planet, $element)
    {
        $pricelist = ConstantsUtils::$pricelist;
        $resource = ConstantsUtils::$resourcesMap;
        $reslist = ConstantsUtils::$reslist;
        $gameSpeed = config('blackout.game_speed');

        $level = ($planet[$resource[$element]]) ? $planet[$resource[$element]] : $user[$resource[$element]];

        if (in_array($element, $reslist['build'])) {
            // Pour un batiment ...
            $cost_metal   = floor($pricelist[$element]['metal']   * pow($pricelist[$element]['factor'], $level));
            $cost_crystal = floor($pricelist[$element]['crystal'] * pow($pricelist[$element]['factor'], $level));
            $time         = ((($cost_crystal) + ($cost_metal)) / $gameSpeed) * (1 / ($planet[$resource['14']] + 1)) * pow(0.5, $planet[$resource['15']]);
            $time         = floor(($time * 60 * 60) * (1 - (($user['rpg_constructeur']) * 0.1)));
        } elseif (in_array($element, $reslist['tech'])) {
            // Pour une recherche
            $cost_metal   = floor($pricelist[$element]['metal']   * pow($pricelist[$element]['factor'], $level));
            $cost_crystal = floor($pricelist[$element]['crystal'] * pow($pricelist[$element]['factor'], $level));
            $intergal_lab = $user[$resource[123]];
            if       ( $intergal_lab < "1" ) {
                $lablevel = $planet[$resource['31']];
            } elseif ( $intergal_lab >= "1" ) {
                $empire = Planet::where('id_owner', $user->id)->get();
                $NbLabs = 0;
                foreach ($empire as $colonie) {
                    $techlevel[$NbLabs] = $colonie[$resource['31']];
                    $NbLabs++;
                }
                if ($intergal_lab >= "1") {
                    $lablevel = 0;
                    for ($lab = 1; $lab <= $intergal_lab; $lab++) {
                        asort($techlevel);
                        $lablevel += $techlevel[$lab - 1];
                    }
                }
            }
            $time         = (($cost_metal + $cost_crystal) / $gameSpeed) / (($lablevel + 1) * 2);
            $time         = floor(($time * 60 * 60) * (1 - (($user['rpg_scientifique']) * 0.1)));
        } elseif (in_array($element, $reslist['defense'])) {
            // Pour les defenses ou la flotte 'tarif fixe' durée adaptée a u niveau nanite et usine robot
            $time         = (($pricelist[$element]['metal'] + $pricelist[$element]['crystal']) / $gameSpeed) * (1 / ($planet[$resource['21']] + 1)) * pow(1 / 2, $planet[$resource['15']]);
            $time         = floor(($time * 60 * 60) * (1 - (($user['rpg_defenseur'])   * 0.375)));
        } elseif (in_array($element, $reslist['fleet'])) {
            $time         = (($pricelist[$element]['metal'] + $pricelist[$element]['crystal']) / $gameSpeed) * (1 / ($planet[$resource['21']] + 1)) * pow(1 / 2, $planet[$resource['15']]);
            $time         = floor(($time * 60 * 60) * (1 - (($user['rpg_technocrate']) * 0.05)));
        }

        return $time;
    }
}

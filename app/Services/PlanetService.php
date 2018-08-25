<?php

namespace App\Services;

use App\Models\Planet;
use App\Models\User;
use App\Utils\ConstantsUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config as ConfigRepository;

class PlanetService
{
    public function getSortedList(User $user, $withoutDestroyed = false)
    {
        $order = $user->planet_sort_order == 1 ? 'DESC' : 'ASC';

        $planets = Planet::where('id_owner', $user->id);

        if ($withoutDestroyed) {
            $planets->where('destruyed', 0);
        }

        if ($user->planet_sort == 0) {
            $planets->orderBy('id', $order);
        } elseif ($user->planet_sort == 1) {
            $planets->orderBy('galaxy')
                ->orderBy('system')
                ->orderBy('planet')
                ->orderBy('planet_type', $order);
        } elseif ($user->planet_sort == 2) {
            $planets->orderBy('name', $order);
        }

        return $planets->get();
    }

    public function setCurrent(Request $request)
    {
        $targetPlanet = $request->query->get('cp');
        $restorePlanet = $request->query->get('re');

        if (is_numeric($targetPlanet) && $restorePlanet == 0) {
            /** @var \App\Models\User $user */
            $user = auth()->user();

            $validPlanet = Planet::where('id', $targetPlanet)->where('id_owner', $user->id)->exists();

            if ($validPlanet) {
                $user->current_planet = $targetPlanet;
                $user->save();
            }
        }
    }

    public function updateResources(User $user, Planet $planet, $updateTime)
    {
        $resource = ConstantsUtils::$resourcesMap;

        $planet['metal_max']     = (floor (ConstantsUtils::BASE_STORAGE_SIZE * pow (1.5, $planet[ $resource[22] ] ))) * (1 + ($user['rpg_stockeur'] * 0.5));
        $planet['crystal_max']   = (floor (ConstantsUtils::BASE_STORAGE_SIZE * pow (1.5, $planet[ $resource[23] ] ))) * (1 + ($user['rpg_stockeur'] * 0.5));
        $planet['deuterium_max'] = (floor (ConstantsUtils::BASE_STORAGE_SIZE * pow (1.5, $planet[ $resource[24] ] ))) * (1 + ($user['rpg_stockeur'] * 0.5));

        // Calculate max storage space (include possible overflows)
        $MaxMetalStorage     = $planet['metal_max'] * ConstantsUtils::MAX_STORAGE_OVERFLOW;
        $MaxCristalStorage   = $planet['crystal_max'] * ConstantsUtils::MAX_STORAGE_OVERFLOW;
        $MaxDeuteriumStorage = $planet['deuterium_max'] * ConstantsUtils::MAX_STORAGE_OVERFLOW;

        // Linear production calculation of various types
        $caps = [];
        $multiplier = config('blackout.resource_multiplier');

        foreach (ConstantsUtils::getProductionGrid() as $id => $data) {
            $level = $planet[$resource[$id]];
            $factor = $planet[$resource[$id] . '_porcent'];

            // Execute formula callbacks here to increase readability
            $formulaMetal = $data['formula']['metal']($level, $factor, $planet->temp_max);
            $formulaCrystal = $data['formula']['crystal']($level, $factor, $planet->temp_max);
            $formulaDeuterium = $data['formula']['deuterium']($level, $factor, $planet->temp_max);
            $formulaEnergy = $data['formula']['energy']($level, $factor, $planet->temp_max);

            $caps['metal_perhour']     += floor($formulaMetal     * $multiplier * (1 + ($user['rpg_geologue']  * 0.05)));
            $caps['crystal_perhour']   += floor($formulaCrystal   * $multiplier * (1 + ($user['rpg_geologue']  * 0.05)));
            $caps['deuterium_perhour'] += floor($formulaDeuterium * $multiplier * (1 + ($user['rpg_geologue']  * 0.05)));

            if ($id < 4) {
                $caps['energy_used'] += floor($formulaEnergy * $multiplier * (1 + ($user['rpg_ingenieur'] * 0.05)));
            } elseif ($id >= 4 ) {
                $caps['energy_max']  += floor($formulaEnergy * $multiplier * (1 + ($user['rpg_ingenieur'] * 0.05)));
            }
        }

        // There is no basic production on a moon (or any production)
        if ($planet['planet_type'] == 3) {
            ConfigRepository::set('metal_basic_income', 0);
            ConfigRepository::set('crystal_basic_income', 0);
            ConfigRepository::set('deuterium_basic_income', 0);

            $planet['metal_perhour']        = 0;
            $planet['crystal_perhour']      = 0;
            $planet['deuterium_perhour']    = 0;
            $planet['energy_used']          = 0;
            $planet['energy_max']           = 0;
        } else {
            $planet['metal_perhour']        = $caps['metal_perhour'];
            $planet['crystal_perhour']      = $caps['crystal_perhour'];
            $planet['deuterium_perhour']    = $caps['deuterium_perhour'];
            $planet['energy_used']          = $caps['energy_used'];
            $planet['energy_max']           = $caps['energy_max'];
        }

        // Calculate last update time
        $ProductionTime               = ($updateTime - $planet['last_update']);
        $planet['last_update'] = $updateTime;

        if ($planet['energy_max'] == 0) {
            // We have no energy, let's enter vacancy mode
            $planet['metal_perhour']     = config('blackout.metal_basic_income');
            $planet['crystal_perhour']   = config('blackout.crystal_basic_income');
            $planet['deuterium_perhour'] = config('blackout.deuterium_basic_income');
            $production_level            = 100;
        } elseif ($planet["energy_max"] >= $planet["energy_used"]) {
            // Normal case (there is enough energy all mines are running at full capacity)
            $production_level            = 100;
        } else {
            // If it lacks energy let's calculate a percentage of production
            $production_level            = floor(($planet['energy_max'] / $planet['energy_used']) * 100);
        }

        // Scale values
        if ($production_level > 100) {
            $production_level = 100;
        } elseif ($production_level < 0) {
            $production_level = 0;
        }

        if ( $planet['metal'] <= $MaxMetalStorage ) {
            $MetalProduction = (($ProductionTime * ($planet['metal_perhour'] / 3600)) * config('blackout.resource_multiplier')) * (0.01 * $production_level);
            $MetalBaseProduc = (($ProductionTime * (config('blackout.metal_basic_income') / 3600 )) * config('blackout.resource_multiplier'));
            $MetalTheorical  = $planet['metal'] + $MetalProduction  +  $MetalBaseProduc;
            if ( $MetalTheorical <= $MaxMetalStorage ) {
                $planet['metal']  = $MetalTheorical;
            } else {
                $planet['metal']  = $MaxMetalStorage;
            }
        }

        if ( $planet['crystal'] <= $MaxCristalStorage ) {
            $CristalProduction = (($ProductionTime * ($planet['crystal_perhour'] / 3600)) * config('blackout.resource_multiplier')) * (0.01 * $production_level);
            $CristalBaseProduc = (($ProductionTime * (config('blackout.crystal_basic_income') / 3600 )) * config('blackout.resource_multiplier'));
            $CristalTheorical  = $planet['crystal'] + $CristalProduction  +  $CristalBaseProduc;
            if ( $CristalTheorical <= $MaxCristalStorage ) {
                $planet['crystal']  = $CristalTheorical;
            } else {
                $planet['crystal']  = $MaxCristalStorage;
            }
        }

        if ( $planet['deuterium'] <= $MaxDeuteriumStorage ) {
            $DeuteriumProduction = (($ProductionTime * ($planet['deuterium_perhour'] / 3600)) * config('blackout.resource_multiplier')) * (0.01 * $production_level);
            $DeuteriumBaseProduc = (($ProductionTime * (config('blackout.deuterium_basic_income') / 3600 )) * config('blackout.resource_multiplier'));
            $DeuteriumTheorical  = $planet['deuterium'] + $DeuteriumProduction  +  $DeuteriumBaseProduc;
            if ( $DeuteriumTheorical <= $MaxDeuteriumStorage ) {
                $planet['deuterium']  = $DeuteriumTheorical;
            } else {
                $planet['deuterium']  = $MaxDeuteriumStorage;
            }
        }

        // @todo handle buildings queue here

        // Fix negative values if any
        if ($planet->metal < 0) {
            $planet->metal = 0;
        }
        if ($planet->crystal < 0) {
            $planet->crystal = 0;
        }
        if ($planet->deuterium < 0) {
            $planet->deuterium = 0;
        }

        // Update database
        $planet->save();
    }

    public function verifyUsedFields(Planet $planet)
    {
        $resource =  ConstantsUtils::$resourcesMap;

        // All buildings
        $total  = $planet[$resource[1]]  + $planet[$resource[2]]  + $planet[$resource[3]] ;
        $total += $planet[$resource[4]]  + $planet[$resource[12]] + $planet[$resource[14]];
        $total += $planet[$resource[15]] + $planet[$resource[21]] + $planet[$resource[22]];
        $total += $planet[$resource[23]] + $planet[$resource[24]] + $planet[$resource[31]];
        $total += $planet[$resource[33]] + $planet[$resource[34]] + $planet[$resource[44]];

        // Add more building types if it's a moon
        if ($planet->planet_type == '3') {
            $total += $planet[$resource[41]] + $planet[$resource[42]] + $planet[$resource[43]];
        }

        // Update number of fields if it turned out to be incorrect
        if ($planet->field_current != $total) {
            $planet->field_current = $total;
            $planet->save();
        }
    }
}

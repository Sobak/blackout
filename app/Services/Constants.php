<?php

namespace App\Services;

class Constants
{
    const BASE_STORAGE_SIZE = 1000000;

    // Maximum number of elements in a fleet build list line and defenses
    const MAX_FLEET_OR_DEFS_PER_ROW = 1000;

    // Maximum storage overflow ratio (1 for 100%, 1.1 for 110% etc)
    const MAX_OVERFLOW = 1.1;

    /**
     * @var array Map resource ID to correspoding database field
     */
    public static $resourcesMap = [
        1 => 'metal_mine',
        2 => 'crystal_mine',
        3 => 'deuterium_sintetizer',
        4 => 'solar_plant',
        12 => 'fusion_plant',
        14 => 'robot_factory',
        15 => 'nano_factory',
        21 => 'hangar',
        22 => 'metal_store',
        23 => 'crystal_store',
        24 => 'deuterium_store',
        31 => 'laboratory',
        33 => 'terraformer',
        34 => 'ally_deposit',
        41 => 'mondbasis',
        42 => 'phalanx',
        43 => 'sprungtor',
        44 => 'silo',

        106 => 'spy_tech',
        108 => 'computer_tech',
        109 => 'military_tech',
        110 => 'defence_tech',
        111 => 'shield_tech',
        113 => 'energy_tech',
        114 => 'hyperspace_tech',
        115 => 'combustion_tech',
        117 => 'impulse_motor_tech',
        118 => 'hyperspace_motor_tech',
        120 => 'laser_tech',
        121 => 'ionic_tech',
        122 => 'buster_tech',
        123 => 'intergalactic_tech',
        124 => 'expedition_tech',
        199 => 'graviton_tech',

        202 => 'small_ship_cargo',
        203 => 'big_ship_cargo',
        204 => 'light_hunter',
        205 => 'heavy_hunter',
        206 => 'crusher',
        207 => 'battle_ship',
        208 => 'colonizer',
        209 => 'recycler',
        210 => 'spy_sonde',
        211 => 'bomber_ship',
        212 => 'solar_satelit',
        213 => 'destructor',
        214 => 'dearth_star',
        215 => 'battleship',

        401 => 'misil_launcher',
        402 => 'small_laser',
        403 => 'big_laser',
        404 => 'gauss_canyon',
        405 => 'ionic_canyon',
        406 => 'buster_canyon',
        407 => 'small_protection_shield',
        408 => 'big_protection_shield',

        502 => 'interceptor_misil',
        503 => 'interplanetary_misil',

        601 => 'rpg_geologue',
        602 => 'rpg_amiral',
        603 => 'rpg_ingenieur',
        604 => 'rpg_technocrate',
        605 => 'rpg_constructeur',
        606 => 'rpg_scientifique',
        607 => 'rpg_stockeur',
        608 => 'rpg_defenseur',
        609 => 'rpg_bunker',
        610 => 'rpg_espion',
        611 => 'rpg_commandant',
        612 => 'rpg_destructeur',
        613 => 'rpg_general',
        614 => 'rpg_raideur',
        615 => 'rpg_empereur',
    ];

    /**
     * @var array List of resource IDs producing goods
     */
    public static $resourcesProd = [
        1,
        2,
        3,
        4,
        12,
        212,
    ];

    public static function getProductionGrid()
    {
        return [
            // Metal mine
            1   => array( 'metal' =>   40, 'crystal' =>   10, 'deuterium' =>    0, 'energy' => 0, 'factor' => 3/2,
                          'formule' => array(
                              'metal'     => 'return   (30 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);',
                              'crystal'   => 'return   "0";',
                              'deuterium' => 'return   "0";',
                              'energy'    => 'return - (10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
            ),
            // Crystal mine
            2   => array( 'metal' =>   30, 'crystal' =>   15, 'deuterium' =>    0, 'energy' => 0, 'factor' => 1.6,
                          'formule' => array(
                              'metal'     => 'return   "0";',
                              'crystal'   => 'return   (20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);',
                              'deuterium' => 'return   "0";',
                              'energy'    => 'return - (10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
            ),
            // Deuterium synthesizer
            3   => array( 'metal' =>  150, 'crystal' =>   50, 'deuterium' =>    0, 'energy' => 0, 'factor' => 3/2,
                          'formule' => array(
                              'metal'     => 'return   "0";',
                              'crystal'   => 'return   "0";',
                              'deuterium' => 'return  ((10 * $BuildLevel * pow((1.1), $BuildLevel)) * (-0.002 * $BuildTemp + 1.28)) * (0.1 * $BuildLevelFactor);',
                              'energy'    => 'return - (30 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
            ),
            // Solar plant
            4   => array( 'metal' =>   50, 'crystal' =>   20, 'deuterium' =>    0, 'energy' => 0, 'factor' => 3/2,
                          'formule' => array(
                              'metal'     => 'return   "0";',
                              'crystal'   => 'return   "0";',
                              'deuterium' => 'return   "0";',
                              'energy'    => 'return   (20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
            ),
            // Fusion reactor
            12  => array( 'metal' =>  500, 'crystal' =>  200, 'deuterium' =>  100, 'energy' => 0, 'factor' => 1.8,
                          'formule' => array(
                              'metal'     => 'return   "0";',
                              'crystal'   => 'return   "0";',
                              'deuterium' => 'return - (10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);',
                              'energy'    => 'return   (50 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);')
            ),
            // Solar satelite
            212 => array( 'metal' =>    0, 'crystal' => 2000, 'deuterium' =>  500, 'energy' => 0, 'factor' => 0.5,
                          'formule' => array(
                              'metal'     => 'return   "0";',
                              'crystal'   => 'return   "0";',
                              'deuterium' => 'return   "0";',
                              'energy'    => 'return  (($BuildTemp / 4) + 20) * $BuildLevel * (0.1 * $BuildLevelFactor);')
            )
        ];
    }
}

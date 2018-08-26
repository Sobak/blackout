<?php

namespace App\Utils;

class ConstantsUtils
{
    /** @var int Maximum number of elements in a fleet build list line and defenses */
    const MAX_FLEET_OR_DEFS_PER_ROW = 1000;

    /** @var float Maximum storage overflow ratio (1 for 100%, 1.1 for 110% etc) */
    const MAX_STORAGE_OVERFLOW = 1.1;

    /** @var int Maximum storage size */
    const BASE_STORAGE_SIZE = 1000000;

    /** @var array Map resource ID to correspoding database field */
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

    /** @var array Define production costs for each resource */
    public static $pricelist = [
        1 =>   ['metal' =>      60, 'crystal' =>      15, 'deuterium' =>       0, 'energy' =>    0, 'factor' => 3/2],
        2 =>   ['metal' =>      48, 'crystal' =>      24, 'deuterium' =>       0, 'energy' =>    0, 'factor' => 1.6],
        3 =>   ['metal' =>     225, 'crystal' =>      75, 'deuterium' =>       0, 'energy' =>    0, 'factor' => 3/2],
        4 =>   ['metal' =>      75, 'crystal' =>      30, 'deuterium' =>       0, 'energy' =>    0, 'factor' => 3/2],
        12 =>  ['metal' =>     900, 'crystal' =>     360, 'deuterium' =>     180, 'energy' =>    0, 'factor' => 1.8],
        14 =>  ['metal' =>     400, 'crystal' =>     120, 'deuterium' =>     200, 'energy' =>    0, 'factor' =>   2],
        15 =>  ['metal' => 1000000, 'crystal' =>  500000, 'deuterium' =>  100000, 'energy' =>    0, 'factor' =>   2],
        21 =>  ['metal' =>     400, 'crystal' =>     200, 'deuterium' =>     100, 'energy' =>    0, 'factor' =>   2],
        22 =>  ['metal' =>    2000, 'crystal' =>       0, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2],
        23 =>  ['metal' =>    2000, 'crystal' =>    1000, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2],
        24 =>  ['metal' =>    2000, 'crystal' =>    2000, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2],
        31 =>  ['metal' =>     200, 'crystal' =>     400, 'deuterium' =>     200, 'energy' =>    0, 'factor' =>   2],
        33 =>  ['metal' =>       0, 'crystal' =>   50000, 'deuterium' =>  100000, 'energy' => 1000, 'factor' =>   2],
        34 =>  ['metal' =>   20000, 'crystal' =>   40000, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2],
        41 =>  ['metal' =>   20000, 'crystal' =>   40000, 'deuterium' =>   20000, 'energy' =>    0, 'factor' =>   2],
        42 =>  ['metal' =>   20000, 'crystal' =>   40000, 'deuterium' =>   20000, 'energy' =>    0, 'factor' =>   2],
        43 =>  ['metal' => 2000000, 'crystal' => 4000000, 'deuterium' => 2000000, 'energy' =>    0, 'factor' =>   2],
        44 =>  ['metal' =>   20000, 'crystal' =>   20000, 'deuterium' =>    1000, 'energy' =>    0, 'factor' =>   2],

        106 => ['metal' =>     200, 'crystal' =>    1000, 'deuterium' =>     200, 'energy' =>    0, 'factor' =>   2],
        108 => ['metal' =>       0, 'crystal' =>     400, 'deuterium' =>     600, 'energy' =>    0, 'factor' =>   2],
        109 => ['metal' =>     800, 'crystal' =>     200, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2],
        110 => ['metal' =>     200, 'crystal' =>     600, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2],
        111 => ['metal' =>    1000, 'crystal' =>       0, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2],
        113 => ['metal' =>       0, 'crystal' =>     800, 'deuterium' =>     400, 'energy' =>    0, 'factor' =>   2],
        114 => ['metal' =>       0, 'crystal' =>    4000, 'deuterium' =>    2000, 'energy' =>    0, 'factor' =>   2],
        115 => ['metal' =>     400, 'crystal' =>       0, 'deuterium' =>     600, 'energy' =>    0, 'factor' =>   2],
        117 => ['metal' =>    2000, 'crystal' =>    4000, 'deuterium' =>    6000, 'energy' =>    0, 'factor' =>   2],
        118 => ['metal' =>   10000, 'crystal' =>   20000, 'deuterium' =>    6000, 'energy' =>    0, 'factor' =>   2],
        120 => ['metal' =>     200, 'crystal' =>     100, 'deuterium' =>       0, 'energy' =>    0, 'factor' =>   2],
        121 => ['metal' =>    1000, 'crystal' =>     300, 'deuterium' =>     100, 'energy' =>    0, 'factor' =>   2],
        122 => ['metal' =>    2000, 'crystal' =>    4000, 'deuterium' =>    1000, 'energy' =>    0, 'factor' =>   2],
        123 => ['metal' =>  240000, 'crystal' =>  400000, 'deuterium' =>  160000, 'energy' =>    0, 'factor' =>   2],
        124 => ['metal' =>    4000, 'crystal' =>    8000, 'deuterium' =>    4000, 'energy' =>    0, 'factor' =>   2],
        199 => ['metal' =>       0, 'crystal' =>       0, 'deuterium' =>       0, 'energy_max' => 300000, 'factor' =>   3],

        202 => ['metal' =>    2000, 'crystal' =>    2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 20  , 'consumption2' => 40  , 'speed' =>      5000, 'speed2' =>     10000, 'capacity' =>    5000 ],
        203 => ['metal' =>    6000, 'crystal' =>    6000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 50  , 'consumption2' => 50  , 'speed' =>      7500, 'speed2' =>      7500, 'capacity' =>   25000 ],
        204 => ['metal' =>    3000, 'crystal' =>    1000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 20  , 'consumption2' => 20  , 'speed' =>     12500, 'speed2' =>     12500, 'capacity' =>      50 ],
        205 => ['metal' =>    6000, 'crystal' =>    4000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 75  , 'consumption2' => 75  , 'speed' =>     10000, 'speed2' =>     15000, 'capacity' =>     100 ],
        206 => ['metal' =>   20000, 'crystal' =>    7000, 'deuterium' =>    2000, 'energy' => 0, 'factor' => 1, 'consumption' => 300 , 'consumption2' => 300 , 'speed' =>     15000, 'speed2' =>     15000, 'capacity' =>     800 ],
        207 => ['metal' =>   45000, 'crystal' =>   15000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 500 , 'consumption2' => 500 , 'speed' =>     10000, 'speed2' =>     10000, 'capacity' =>    1500 ],
        208 => ['metal' =>   10000, 'crystal' =>   20000, 'deuterium' =>   10000, 'energy' => 0, 'factor' => 1, 'consumption' => 1000, 'consumption2' => 1000, 'speed' =>      2500, 'speed2' =>      2500, 'capacity' =>    7500 ],
        209 => ['metal' =>   10000, 'crystal' =>    6000, 'deuterium' =>    2000, 'energy' => 0, 'factor' => 1, 'consumption' => 300 , 'consumption2' => 300 , 'speed' =>      2000, 'speed2' =>      2000, 'capacity' =>   20000 ],
        210 => ['metal' =>       0, 'crystal' =>    1000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1, 'consumption' => 1   , 'consumption2' => 1   , 'speed' => 100000000, 'speed2' => 100000000, 'capacity' =>       5 ],
        211 => ['metal' =>   50000, 'crystal' =>   25000, 'deuterium' =>   15000, 'energy' => 0, 'factor' => 1, 'consumption' => 1000, 'consumption2' => 1000, 'speed' =>      4000, 'speed2' =>      5000, 'capacity' =>     500 ],
        212 => ['metal' =>       0, 'crystal' =>    2000, 'deuterium' =>     500, 'energy' => 0, 'factor' => 1, 'consumption' => 0   , 'consumption2' => 0   , 'speed' =>         0, 'speed2' =>         0, 'capacity' =>       0 ],
        213 => ['metal' =>   60000, 'crystal' =>   50000, 'deuterium' =>   15000, 'energy' => 0, 'factor' => 1, 'consumption' => 1000, 'consumption2' => 1000, 'speed' =>      5000, 'speed2' =>      5000, 'capacity' =>    2000 ],
        214 => ['metal' => 5000000, 'crystal' => 4000000, 'deuterium' => 1000000, 'energy' => 0, 'factor' => 1, 'consumption' => 1   , 'consumption2' => 1   , 'speed' =>       100, 'speed2' =>       100, 'capacity' => 1000000 ],
        215 => ['metal' =>   30000, 'crystal' =>   40000, 'deuterium' =>   15000, 'energy' => 0, 'factor' => 1, 'consumption' => 250 , 'consumption2' => 250 , 'speed' =>     10000, 'speed2' =>     10000, 'capacity' =>     750 ],

        401 => ['metal' =>    2000, 'crystal' =>       0, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ],
        402 => ['metal' =>    1500, 'crystal' =>     500, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ],
        403 => ['metal' =>    6000, 'crystal' =>    2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ],
        404 => ['metal' =>   20000, 'crystal' =>   15000, 'deuterium' =>    2000, 'energy' => 0, 'factor' => 1 ],
        405 => ['metal' =>    2000, 'crystal' =>    6000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ],
        406 => ['metal' =>   50000, 'crystal' =>   50000, 'deuterium' =>   30000, 'energy' => 0, 'factor' => 1 ],
        407 => ['metal' =>   10000, 'crystal' =>   10000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ],
        408 => ['metal' =>   50000, 'crystal' =>   50000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ],

        502 => ['metal' =>    8000, 'crystal' =>    2000, 'deuterium' =>       0, 'energy' => 0, 'factor' => 1 ],
        503 => ['metal' =>   12500, 'crystal' =>    2500, 'deuterium' =>   10000, 'energy' => 0, 'factor' => 1 ],

        601 => ['max' =>  20],
        602 => ['max' =>  20],
        603 => ['max' =>  10],
        604 => ['max' =>  10],
        605 => ['max' =>   3],
        606 => ['max' =>   3],
        607 => ['max' =>   2],
        608 => ['max' =>   2],
        609 => ['max' =>   1],
        610 => ['max' =>   2],
        611 => ['max' =>   2],
        612 => ['max' =>   1],
        613 => ['max' =>   3],
        614 => ['max' =>   1],
        615 => ['max' =>   1],
    ];

    /** @var array Assign each resource into the group */
    public static $reslist = [
        'build' => [1, 2, 3, 4, 12, 14, 15, 21, 22, 23, 24, 31, 33, 34, 44, 41, 42, 43],
        'tech' => [106, 108, 109, 110, 111, 113, 114, 115, 117, 118, 120, 121, 122, 123, 124, 199],
        'fleet' => [202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215],
        'defense' => [401, 402, 403, 404, 405, 406, 407, 408, 502, 503],
        'officier' => [601, 602, 603, 604, 605, 606, 607, 608, 609, 610, 611, 612, 613, 614, 615],
        'prod' => [1, 2, 3, 4, 12, 212],
    ];

    /**
     * Return production grid.
     *
     * Return grid defining costs and production formulas for every resource
     * able to creating goods. Keyed by respective resource ID. For the usage
     *
     * @see \App\Services\PlanetService::updateResources()
     *
     * @return array
     */
    public static function getProductionGrid()
    {
        return [
            // Metal mine
            1 => [
                'metal' => 40,
                'crystal' => 10,
                'deuterium' => 0,
                'energy' => 0,
                'factor' => 3/2,
                'formula' => [
                    'metal' => function ($level, $factor) {
                        return (30 * $level * pow(1.1, $level)) * (0.1 * $factor);
                    },
                    'crystal' => function () {
                        return 0;
                    },
                    'deuterium' => function () {
                        return 0;
                    },
                    'energy' => function ($level, $factor) {
                        return - (10 * $level * pow(1.1, $level)) * (0.1 * $factor);
                    },
                ],
            ],
            // Crystal mine
            2 => [
                'metal' => 30,
                'crystal' => 15,
                'deuterium' => 0,
                'energy' => 0,
                'factor' => 1.6,
                'formula' => [
                    'metal' => function () {
                        return 0;
                    },
                    'crystal' => function ($level, $factor) {
                        return (20 * $level * pow(1.1, $level)) * (0.1 * $factor);
                    },
                    'deuterium' => function () {
                        return 0;
                    },
                    'energy' => function ($level, $factor) {
                        return - (10 * $level * pow(1.1, $level)) * (0.1 * $factor);
                    },
                ],
            ],
            // Deuterium synthesizer
            3 => [
                'metal' => 150,
                'crystal' => 50,
                'deuterium' => 0,
                'energy' => 0,
                'factor' => 3/2,
                'formula' => [
                    'metal' => function () {
                        return 0;
                    },
                    'crystal' => function () {
                        return 0;
                    },
                    'deuterium' => function ($level, $factor, $planetTemp) {
                        return  ((10 * $level * pow(1.1, $level)) * (-0.002 * $planetTemp + 1.28)) * (0.1 * $factor);
                    },
                    'energy' => function ($level, $factor) {
                        return - (30 * $level * pow(1.1, $level)) * (0.1 * $factor);
                    },
                ],
            ],
            // Solar plant
            4 => [
                'metal' => 50,
                'crystal' => 20,
                'deuterium' => 0,
                'energy' => 0,
                'factor' => 3/2,
                'formula' => [
                    'metal' => function () {
                        return 0;
                    },
                    'crystal' => function () {
                        return 0;
                    },
                    'deuterium' => function () {
                        return 0;
                    },
                    'energy' => function ($level, $factor) {
                        return   (20 * $level * pow(1.1, $level)) * (0.1 * $factor);
                    },
                ],
            ],
            // Fusion reactor
            12 => [
                'metal' => 500,
                'crystal' => 200,
                'deuterium' => 100,
                'energy' => 0,
                'factor' => 1.8,
                'formula' => [
                    'metal' => function () {
                        return 0;
                    },
                    'crystal' => function () {
                        return 0;
                    },
                    'deuterium' => function ($level, $factor) {
                        return - (10 * $level * pow(1.1, $level)) * (0.1 * $factor);
                    },
                    'energy' => function ($level, $factor) {
                        return (50 * $level * pow(1.1, $level)) * (0.1 * $factor);
                    },
                ],
            ],
            // Solar satelite
            212 => [
                'metal' => 0,
                'crystal' => 2000,
                'deuterium' => 500,
                'energy' => 0,
                'factor' => 0.5,
                'formula' => [
                    'metal' => function () {
                        return 0;
                    },
                    'crystal' => function () {
                        return 0;
                    },
                    'deuterium' => function () {
                        return 0;
                    },
                    'energy' => function ($level, $factor, $planetTemp) {
                        return  (($planetTemp / 4) + 20) * $level * (0.1 * $factor);
                    },
                ],
            ],
        ];
    }
}

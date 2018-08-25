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
                        return (10 * $level * pow(1.1, $level)) * (0.1 * $factor);
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
                        return (10 * $level * pow(1.1, $level)) * (0.1 * $factor);
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

<?php

use App\Models\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->string('config_name', 64)->default('');
            $table->text('config_value');
        });

        Config::unguard();

        foreach ($this->getDefaultConfig() as $name => $value) {
            Config::create(['config_name' => $name, 'config_value' => $value]);
        }

        Config::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }

    protected function getDefaultConfig()
    {
        return [
            'game_speed' => 2500,
            'fleet_speed' => 2500,
            'resource_multiplier' => 1,
            'Fleet_Cdr' => 30,
            'Defs_Cdr' => 30,
            'initial_fields' => 163,
            'game_name' => 'XNova',
            'game_disable' => 1,
            'close_reason' => '',
            'metal_basic_income' => 20,
            'crystal_basic_income' => 10,
            'deuterium_basic_income' => 0,
            'energy_basic_income' => 0,
            'BuildLabWhileRun' => 0,
            'LastSettedGalaxyPos' => 1,
            'LastSettedSystemPos' => 8,
            'LastSettedPlanetPos' => 3,
            'urlaubs_modus_erz' => 1,
            'noobprotection' => 1,
            'noobprotectiontime' => 5000,
            'noobprotectionmulti' => 5,
            'forum_url' => 'http://www.xnova.fr/forum',
            'OverviewNewsFrame' => 1,
            'OverviewNewsText' => '',
            'OverviewExternChat' => 0,
            'OverviewExternChatCmd' => '',
            'OverviewBanner' => '0',
            'OverviewClickBanner' => '',
            'debug' => 0,
        ];
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('id_owner')->nullable();
            $table->integer('id_level')->default(0);
            $table->integer('galaxy')->default(0);
            $table->integer('system')->default(0);
            $table->integer('planet')->default(0);
            $table->integer('last_update')->nullable();
            $table->integer('planet_type')->default(1);
            $table->integer('destruyed')->default(0);
            $table->integer('b_building')->default(0);
            $table->text('b_building_id')->nullable();
            $table->integer('b_tech')->default(0);
            $table->integer('b_tech_id')->default(0);
            $table->integer('b_hangar')->default(0);
            $table->text('b_hangar_id')->nullable();
            $table->integer('b_hangar_plus')->default(0);
            $table->string('image', 32)->default('normaltempplanet01');
            $table->integer('diameter')->default(12800);
            $table->bigInteger('points')->default(0);
            $table->bigInteger('ranks')->default(0);
            $table->integer('field_current')->default(0);
            $table->integer('field_max')->default(163);
            $table->integer('temp_min')->default(-17);
            $table->integer('temp_max')->default(23);
            $table->double('metal', 132, 8)->default(0.00000000);
            $table->integer('metal_perhour')->default(0);
            $table->bigInteger('metal_max')->default(100000);
            $table->double('crystal', 132, 8)->default(0.00000000);
            $table->integer('crystal_perhour')->default(0);
            $table->bigInteger('crystal_max')->default(100000);
            $table->double('deuterium', 132, 8)->default(0.00000000);
            $table->integer('deuterium_perhour')->default(0);
            $table->bigInteger('deuterium_max')->default(100000);
            $table->integer('energy_used')->default(0);
            $table->integer('energy_max')->default(0);
            $table->integer('metal_mine')->default(0);
            $table->integer('crystal_mine')->default(0);
            $table->integer('deuterium_sintetizer')->default(0);
            $table->integer('solar_plant')->default(0);
            $table->integer('fusion_plant')->default(0);
            $table->integer('robot_factory')->default(0);
            $table->integer('nano_factory')->default(0);
            $table->integer('hangar')->default(0);
            $table->integer('metal_store')->default(0);
            $table->integer('crystal_store')->default(0);
            $table->integer('deuterium_store')->default(0);
            $table->integer('laboratory')->default(0);
            $table->integer('terraformer')->default(0);
            $table->integer('ally_deposit')->default(0);
            $table->integer('silo')->default(0);
            $table->bigInteger('small_ship_cargo')->default(0);
            $table->bigInteger('big_ship_cargo')->default(0);
            $table->bigInteger('light_hunter')->default(0);
            $table->bigInteger('heavy_hunter')->default(0);
            $table->bigInteger('crusher')->default(0);
            $table->bigInteger('battle_ship')->default(0);
            $table->bigInteger('colonizer')->default(0);
            $table->bigInteger('recycler')->default(0);
            $table->bigInteger('spy_sonde')->default(0);
            $table->bigInteger('bomber_ship')->default(0);
            $table->bigInteger('solar_satelit')->default(0);
            $table->bigInteger('destructor')->default(0);
            $table->bigInteger('dearth_star')->default(0);
            $table->bigInteger('battleship')->default(0);
            $table->bigInteger('misil_launcher')->default(0);
            $table->bigInteger('small_laser')->default(0);
            $table->bigInteger('big_laser')->default(0);
            $table->bigInteger('gauss_canyon')->default(0);
            $table->bigInteger('ionic_canyon')->default(0);
            $table->bigInteger('buster_canyon')->default(0);
            $table->integer('small_protection_shield')->default(0);
            $table->integer('big_protection_shield')->default(0);
            $table->integer('interceptor_misil')->default(0);
            $table->integer('interplanetary_misil')->default(0);
            $table->integer('metal_mine_porcent')->default(10);
            $table->integer('crystal_mine_porcent')->default(10);
            $table->integer('deuterium_sintetizer_porcent')->default(10);
            $table->integer('solar_plant_porcent')->default(10);
            $table->integer('fusion_plant_porcent')->default(10);
            $table->integer('solar_satelit_porcent')->default(10);
            $table->bigInteger('mondbasis')->default(0);
            $table->bigInteger('phalanx')->default(0);
            $table->bigInteger('sprungtor')->default(0);
            $table->integer('last_jump_time')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planets');
    }
}

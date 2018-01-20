<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 64)->default('');
            $table->string('password', 64)->default('');
            $table->rememberToken();
            $table->string('email', 64)->default('');
            $table->string('email_2', 64)->default('');
            $table->string('lang', 8);
            $table->tinyInteger('authlevel')->default(0);
            $table->integer('id_planet')->default(0);
            $table->integer('galaxy')->default(0);
            $table->integer('system')->default(0);
            $table->integer('planet')->default(0);
            $table->integer('current_planet')->default(0);
            $table->string('user_lastip', 16)->default('');
            $table->text('user_agent')->nullable();
            $table->integer('register_time')->default(0);
            $table->integer('onlinetime')->default(0);
            $table->string('dpath')->default('');
            $table->tinyInteger('noipcheck')->default(1);
            $table->tinyInteger('planet_sort')->default(0);
            $table->tinyInteger('planet_sort_order')->default(0);
            $table->tinyInteger('spio_anz')->default(1);
            $table->tinyInteger('settings_tooltiptime')->default(5);
            $table->tinyInteger('settings_fleetactions')->default(0);
            $table->tinyInteger('settings_allylogo')->default(0);
            $table->tinyInteger('settings_esp')->default(1);
            $table->tinyInteger('settings_wri')->default(1);
            $table->tinyInteger('settings_bud')->default(1);
            $table->tinyInteger('settings_mis')->default(1);
            $table->tinyInteger('settings_rep')->default(0);
            $table->tinyInteger('urlaubs_modus')->default(0);
            $table->tinyInteger('db_deaktjava')->default(0);
            $table->text('fleet_shortcut')->nullable();
            $table->integer('b_tech_planet')->default(0);
            $table->integer('spy_tech')->default(0);
            $table->integer('computer_tech')->default(0);
            $table->integer('military_tech')->default(0);
            $table->integer('defence_tech')->default(0);
            $table->integer('shield_tech')->default(0);
            $table->integer('energy_tech')->default(0);
            $table->integer('hyperspace_tech')->default(0);
            $table->integer('combustion_tech')->default(0);
            $table->integer('impulse_motor_tech')->default(0);
            $table->integer('hyperspace_motor_tech')->default(0);
            $table->integer('laser_tech')->default(0);
            $table->integer('ionic_tech')->default(0);
            $table->integer('buster_tech')->default(0);
            $table->integer('intergalactic_tech')->default(0);
            $table->integer('expedition_tech')->default(0);
            $table->integer('graviton_tech')->default(0);
            $table->integer('ally_id')->default(0);
            $table->string('ally_name', 32)->default('');
            $table->integer('ally_request')->default(0);
            $table->text('ally_request_text')->nullable();
            $table->integer('ally_register_time')->default(0);
            $table->integer('ally_rank_id')->default(0);
            $table->integer('rpg_geologue')->default(0);
            $table->integer('rpg_amiral')->default(0);
            $table->integer('rpg_ingenieur')->default(0);
            $table->integer('rpg_technocrate')->default(0);
            $table->integer('rpg_espion')->default(0);
            $table->integer('rpg_constructeur')->default(0);
            $table->integer('rpg_scientifique')->default(0);
            $table->integer('rpg_commandant')->default(0);
            $table->integer('rpg_points')->default(0);
            $table->integer('rpg_stockeur')->default(0);
            $table->integer('rpg_defenseur')->default(0);
            $table->integer('rpg_destructeur')->default(0);
            $table->integer('rpg_general')->default(0);
            $table->integer('rpg_bunker')->default(0);
            $table->integer('rpg_raideur')->default(0);
            $table->integer('rpg_empereur')->default(0);
            $table->integer('lvl_minier')->default(1);
            $table->integer('lvl_raid')->default(1);
            $table->integer('xpraid')->default(0);
            $table->integer('xpminier')->default(0);
            $table->integer('bana')->nullable();
            $table->integer('urlaubs_modus_time')->default(0);
            $table->integer('deltime')->default(0);
            $table->string('aktywnosc')->default('');
            $table->string('kod_aktywujacy')->default('');
            $table->integer('time_aktyw')->default(0);
            $table->integer('ataker')->default(0);
            $table->integer('atakin')->default(0);
            $table->integer('banaday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

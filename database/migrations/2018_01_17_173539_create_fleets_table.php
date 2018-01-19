<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->bigIncrements('fleet_id');
            $table->integer('fleet_owner')->default(0);
            $table->integer('fleet_mission')->default(0);
            $table->bigInteger('fleet_amount')->default(0);
            $table->text('fleet_array')->nullable();
            $table->integer('fleet_start_time')->default(0);
            $table->integer('fleet_start_galaxy')->default(0);
            $table->integer('fleet_start_system')->default(0);
            $table->integer('fleet_start_planet')->default(0);
            $table->integer('fleet_start_type')->default(0);
            $table->integer('fleet_end_time')->default(0);
            $table->integer('fleet_end_stay')->default(0);
            $table->integer('fleet_end_galaxy')->default(0);
            $table->integer('fleet_end_system')->default(0);
            $table->integer('fleet_end_planet')->default(0);
            $table->integer('fleet_end_type')->default(0);
            $table->integer('fleet_taget_owner')->default(0);
            $table->bigInteger('fleet_resource_metal')->default(0);
            $table->bigInteger('fleet_resource_crystal')->default(0);
            $table->bigInteger('fleet_resource_deuterium')->default(0);
            $table->integer('fleet_target_owner')->default(0);
            $table->integer('fleet_group')->default(0);
            $table->integer('fleet_mess')->default(0);
            $table->integer('start_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleets');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statpoints', function (Blueprint $table) {
            $table->integer('id_owner');
            $table->integer('id_ally');
            $table->integer('stat_type');
            $table->integer('stat_code');
            $table->integer('tech_rank');
            $table->integer('tech_old_rank');
            $table->bigInteger('tech_points');
            $table->integer('tech_count');
            $table->integer('build_rank');
            $table->integer('build_old_rank');
            $table->bigInteger('build_points');
            $table->integer('build_count');
            $table->integer('defs_rank');
            $table->integer('defs_old_rank');
            $table->bigInteger('defs_points');
            $table->integer('defs_count');
            $table->integer('fleet_rank');
            $table->integer('fleet_old_rank');
            $table->bigInteger('fleet_points');
            $table->integer('fleet_count');
            $table->integer('total_rank');
            $table->integer('total_old_rank');
            $table->bigInteger('total_points');
            $table->integer('total_count');
            $table->integer('stat_date');

            $table->index('tech_points', 'TECH');
            $table->index('build_points', 'BUILDS');
            $table->index('defs_points', 'DEFS');
            $table->index('fleet_points', 'FLEET');
            $table->index('total_points', 'TOTAL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statpoints');
    }
}

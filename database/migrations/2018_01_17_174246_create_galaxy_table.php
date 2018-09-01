<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalaxyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galaxy', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('galaxy')->default(0);
            $table->integer('system')->default(0);
            $table->integer('planet')->default(0);
            $table->integer('id_planet')->default(0);
            $table->bigInteger('metal')->default(0);
            $table->bigInteger('crystal')->default(0);
            $table->integer('id_luna')->default(0);
            $table->integer('luna')->default(0);

            $table->index('galaxy', 'galaxy');
            $table->index('system', 'system');
            $table->index('planet', 'planet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galaxy');
    }
}

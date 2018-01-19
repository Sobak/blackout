<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnonceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonce', function (Blueprint $table) {
            $table->increments('id');
            $table->text('user');
            $table->integer('galaxie');
            $table->integer('systeme');
            $table->bigInteger('metala');
            $table->bigInteger('cristala');
            $table->bigInteger('deuta');
            $table->bigInteger('metals');
            $table->bigInteger('cristals');
            $table->bigInteger('deuts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonce');
    }
}

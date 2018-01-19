<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iraks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('zeit')->nullable();
            $table->integer('galaxy')->nullable();
            $table->integer('system')->nullable();
            $table->integer('planet')->nullable();
            $table->integer('galaxy_angreifer')->nullable();
            $table->integer('system_angreifer')->nullable();
            $table->integer('planet_angreifer')->nullable();
            $table->integer('owner')->nullable();
            $table->integer('zielid')->nullable();
            $table->integer('anzahl')->nullable();
            $table->integer('primaer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iraks');
    }
}

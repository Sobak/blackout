<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable();
            $table->text('teilnehmer')->nullable();
            $table->text('flotten')->nullable();
            $table->integer('ankunft')->nullable();
            $table->integer('galaxy')->nullable();
            $table->integer('system')->nullable();
            $table->integer('planet')->nullable();
            $table->integer('eingeladen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aks');
    }
}

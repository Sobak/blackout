<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_luna')->default(0);
            $table->string('name', 11)->default('Lune');
            $table->string('image', 11)->default('mond');
            $table->integer('destruyed')->default(0);
            $table->integer('id_owner')->nullable();
            $table->integer('galaxy')->nullable();
            $table->integer('system')->nullable();
            $table->integer('lunapos')->nullable();
            $table->integer('temp_min')->default(0);
            $table->integer('temp_max')->default(0);
            $table->integer('diameter')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRwTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rw', function (Blueprint $table) {
            $table->integer('id_owner1')->default(0);
            $table->integer('id_owner2')->default(0);
            $table->string('rid', 72);
            $table->text('raport');
            $table->unsignedTinyInteger('a_zestrzelona')->default(0);
            $table->unsignedInteger('time')->default(0);

            $table->unique('rid', 'rid');
            $table->index(['id_owner1', 'rid'], 'id_owner1');
            $table->index(['id_owner2', 'rid'], 'id_owner2');
            $table->index('time', 'time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rw');
    }
}

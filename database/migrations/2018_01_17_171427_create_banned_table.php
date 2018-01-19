<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banned', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('who', 11)->default('');
            $table->text('theme');
            $table->string('who2', 11)->default('');
            $table->integer('time')->default(0);
            $table->integer('longer')->default(0);
            $table->string('author', 11)->default('');
            $table->string('email', 20)->default('');

            $table->index('id', 'ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banned');
    }
}

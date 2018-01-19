<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllianceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alliance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ally_name', 32)->default('');
            $table->string('ally_tag', 8)->default('');
            $table->integer('ally_owner')->default(0);
            $table->integer('ally_register_time')->default(0);
            $table->text('ally_description')->nullable();
            $table->string('ally_web')->default('');
            $table->text('ally_text')->nullable();
            $table->string('ally_image')->default('');
            $table->text('ally_request')->nullable();
            $table->text('ally_request_waiting')->nullable();
            $table->tinyInteger('ally_request_notallow')->default(0);
            $table->string('ally_owner_range', 32)->default('');
            $table->text('ally_ranks')->nullable();
            $table->integer('ally_members')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alliance');
    }
}

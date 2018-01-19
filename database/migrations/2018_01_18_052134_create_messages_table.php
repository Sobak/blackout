<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('message_id');
            $table->integer('message_owner')->default(0);
            $table->integer('message_sender')->default(0);
            $table->integer('message_time')->default(0);
            $table->integer('message_type')->default(0);
            $table->string('message_from', 48)->nullable();
            $table->string('message_subject', 48)->nullable();
            $table->text('message_text')->nullable();
            $table->tinyInteger('message_unread')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}

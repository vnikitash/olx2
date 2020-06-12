<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('from_user_id')->unsigned();
            $table->bigInteger('to_user_id')->unsigned();
            $table->foreign('from_user_id')
                ->references('id')->on('users');
            $table->foreign('to_user_id')
                ->references('id')->on('users');
            $table->string('message');
            $table->bigInteger('advertisement_id')->unsigned();
            $table->foreign('advertisement_id')
                ->references('id')->on('advertisements');
            $table->string('group')->index();
            $table->timestamps();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('advertisement_id')->unsigned();
            $table->bigInteger('telegram_user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('advertisement_id')
                ->references('id')->on('advertisements');
            $table->foreign('telegram_user_id')
                ->references('id')->on('telegram_users');
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
        Schema::dropIfExists('advertisement_user_subscriptions');
    }
}

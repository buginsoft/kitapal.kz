<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('us_id');
            $table->unsignedBigInteger('us_user_id');
            $table->unsignedBigInteger('us_subscription_id');
            $table->boolean('us_active');
            $table->boolean('us_trial');
            $table->date('us_final_date');
            $table->timestamps();
            
            $table->foreign('us_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('us_subscription_id')->references('subscription_id')->on('subscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscriptions');
    }
}

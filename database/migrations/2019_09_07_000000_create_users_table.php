<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('user_role_id')->unsigned()->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80)
                        ->unique()
                        ->nullable()
                        ->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

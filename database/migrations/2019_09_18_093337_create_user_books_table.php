<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_books', function (Blueprint $table) {
            $table->bigIncrements('ub_id');
            $table->unsignedBigInteger('ub_user_id');
            $table->unsignedBigInteger('ub_book_id');
            $table->boolean('is_favorite')->nullable();
            $table->boolean('is_read')->nullable();
            $table->timestamps();

            $table->foreign('ub_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('ub_book_id')->references('book_id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_books');
    }
}

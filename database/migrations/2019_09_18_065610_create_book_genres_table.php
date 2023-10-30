<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_genres', function (Blueprint $table) {
            $table->bigIncrements('book_genre_id');
            $table->unsignedBigInteger('bg_book_id');
            $table->unsignedBigInteger('bg_genre_id');
            $table->timestamps();

            $table->foreign('bg_book_id')->references('book_id')->on('books')->onDelete('cascade');
            $table->foreign('bg_genre_id')->references('genre_id')->on('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_genres');
    }
}

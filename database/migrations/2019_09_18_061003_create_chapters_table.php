<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->bigIncrements('chapter_id');
            $table->unsignedBigInteger('ch_book_id');
            $table->string('chapter_name');
            $table->time('chapter_time');
            $table->integer('sort_num')->unsigned();
            $table->timestamps();

            $table->foreign('ch_book_id')->references('book_id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}

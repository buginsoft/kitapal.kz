<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('book_id');
            $table->string('book_name');
            $table->string('book_image');
            $table->string('author');
            $table->text('book_description');
            $table->string('read_person');
            $table->string('audio_file');
            $table->double('audio_size');
            $table->integer('audio_length')->unsigned();
            $table->string('copyright');
            $table->string('book_lang');
            $table->unsignedBigInteger('book_collection_id')->nullable();
            $table->integer('book_views')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('book_collection_id')->references('collection_id')->on('collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}

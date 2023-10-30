<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->bigIncrements('text_id');
            $table->string('title_ru')->nullable();
            $table->string('title_kz')->nullable();
            $table->string('title_en')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_kz')->nullable();
            $table->text('text_en')->nullable();
            $table->integer('text_place')->unsigned();
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
        Schema::dropIfExists('texts');
    }
}

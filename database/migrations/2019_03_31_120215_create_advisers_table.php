<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('advisers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('undergraduate_id')->unsigned();
            $table->foreign('undergraduate_id')->references('id')->on('undergraduates')->onDelete('cascade');
            $table->integer('lecturer_id')->unsigned();
            $table->foreign('lecturer_id')->references('id')->on('lecturers');
            $table->boolean('position')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('advisers');
    }
};

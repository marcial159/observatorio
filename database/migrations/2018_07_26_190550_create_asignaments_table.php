<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('asignaments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('career_id')->unsigned();
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');
            $table->integer('headquarter_id')->unsigned();
            $table->foreign('headquarter_id')->references('id')->on('headquarters')->onDelete('cascade');
            $table->string('local','6');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignaments');
    }
};

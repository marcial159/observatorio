<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->integer('career_id')->unsigned()->nullable();
            $table->foreign('career_id')->references('id')->on('careers');
            $table->boolean('status')->default(1);
            $table->boolean('category')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lines');
    }
};

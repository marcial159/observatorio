<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', '100');
            $table->string('ambient', '10');
            $table->integer('asignament_id')->unsigned();
            $table->foreign('asignament_id')->references('id')->on('asignaments');
            $table->string('description', '200')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laboratories');
    }
};

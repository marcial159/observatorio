<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('process', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title','50')->unique();
            $table->string('description','100')->nullable()->default(null);
            $table->unsignedBigInteger('type_project_id');
            $table->foreign('type_project_id')->references('id')->on('type_projects');
            $table->boolean('status')->unsigned();
            $table->integer('maxy')->unsigned();
            $table->integer('maxm')->unsigned();
            $table->integer('maxd')->unsigned();
            $table->integer('miny')->unsigned();
            $table->integer('minm')->unsigned();
            $table->integer('mind')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('process');
    }
};

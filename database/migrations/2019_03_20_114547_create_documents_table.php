<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table){
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('project_code',6);
            $table->integer('type')->unsigned();
            $table->integer('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('files');
            $table->integer('number')->unsigned();
            $table->date('date');
            $table->string('description')->nullable();
            $table->char('format', 4);
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};

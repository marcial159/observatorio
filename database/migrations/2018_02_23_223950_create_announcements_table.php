<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', '300');
            $table->unsignedBigInteger('type_project_id');
            $table->foreign('type_project_id')->references('id')->on('type_projects');
            $table->string('resolution','50')->unique();
            $table->string('short','50');
            $table->boolean('status')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};

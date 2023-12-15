<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('headquarters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','30');
            $table->string('position','40');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('headquarters');
    }
};

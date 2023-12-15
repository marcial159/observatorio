<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denomination','20');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorys');
    }
};

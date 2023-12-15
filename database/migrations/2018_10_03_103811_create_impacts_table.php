<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('impacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title','15');
        });
    }

    public function down()
    {
        Schema::dropIfExists('impacts');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('document',20)->unique()->nullable();
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->enum('gender',['M','F'])->nullable();
            $table->string('email',100)->unique()->nullable();
            $table->string('phone',30)->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('persons');
    }
};

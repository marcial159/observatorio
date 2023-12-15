<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('process_id')->unsigned();
            $table->foreign('process_id')->references('id')->on('process')->onDelete('cascade');
            $table->integer('from');
            $table->integer('to');
            $table->string('color',20)->default('green');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
};

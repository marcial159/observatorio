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
        Schema::create('investigation_lecturer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lecturer_id')->unsigned();
            $table->foreign('lecturer_id')->references('id')->on('lecturers');
            $table->integer('investigation_id')->unsigned();
            $table->foreign('investigation_id')->references('id')->on('investigations')->onDelete('cascade');
            $table->boolean('principal')->default(0);
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
        Schema::dropIfExists('investigation_lecturer');
    }
};

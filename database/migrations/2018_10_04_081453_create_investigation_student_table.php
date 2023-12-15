<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('investigation_student', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('investigation_id')->unsigned();
            $table->foreign('investigation_id')->references('id')->on('investigations')->onDelete('cascade');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('investigation_student');
    }
};

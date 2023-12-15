<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('undergraduates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',6)->unique();
            $table->string('title','300');
            $table->text('general');
            $table->text('specific')->nullable();
            $table->string('resolution','50');
            $table->date('resolution_date');
            $table->integer('line_id')->unsigned();
            $table->foreign('line_id')->references('id')->on('lines');
            $table->integer('asignament_id')->unsigned();
            $table->foreign('asignament_id')->references('id')->on('asignaments');
            $table->integer('finance_id')->unsigned();
            $table->foreign('finance_id')->references('id')->on('finances');
            $table->integer('announcement_id')->unsigned()->nullable();
            $table->foreign('announcement_id')->references('id')->on('announcements');
            $table->unsignedDecimal('amount','10','2')->unsigned();
            $table->date('start');
            $table->date('end');
            $table->date('cronogram_finish');
            $table->date('period_finish');
            $table->date('extension_finish')->nullable();
            $table->integer('status')->unsigned();
            $table->text('report')->nullable();
            $table->integer('advance')->unsigned()->nullable()->default(0);
            $table->unsignedBigInteger('monitor_id')->nullable();
            $table->foreign('monitor_id')->references('id')->on('users');
            $table->integer('step_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('undergraduate');
    }
};

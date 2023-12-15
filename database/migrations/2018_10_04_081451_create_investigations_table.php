<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('investigations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',7)->unique();
            $table->string('title','300');
            $table->integer('asignament_id')->unsigned();
            $table->foreign('asignament_id')->references('id')->on('asignaments');
            $table->integer('line_id')->unsigned();
            $table->foreign('line_id')->references('id')->on('lines');
            $table->string('resolution','50');
            $table->date('resolution_date');
            $table->date('start');
            $table->date('end');
            $table->integer('announcement_id')->unsigned();
            $table->foreign('announcement_id')->references('id')->on('announcements');
            $table->integer('impact_id')->unsigned();
            $table->foreign('impact_id')->references('id')->on('impacts');
            $table->text('general');
            $table->text('specific')->nullable();
            $table->text('observation')->nullable();
            $table->date('min_period')->nullable();
            $table->date('max_period')->nullable();
            $table->date('chrono_period')->nullable();
            $table->date('exten_period')->nullable();
            $table->integer('advance')->unsigned()->default(0);
            $table->integer('status')->unsigned()->default(1);
            $table->text('diffusion')->nullable();
            $table->unsignedBigInteger('monitor_id')->nullable();
            $table->foreign('monitor_id')->references('id')->on('users');
            $table->integer('node_id')->unsigned();
            $table->foreign('node_id')->references('id')->on('nodes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('investigations');
    }
};

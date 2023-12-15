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
        Schema::create('investigation_nodes', function (Blueprint $table) {
            $table->id();
            $table->integer('investigation_id')->unsigned();
            $table->foreign('investigation_id')->references('id')->on('investigations')->onDelete('cascade');
            $table->integer('node_id')->unsigned();
            $table->foreign('node_id')->references('id')->on('nodes')->onDelete('cascade');
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
        Schema::dropIfExists('investigation_nodes');
    }
};

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
        Schema::create('concepts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('project_items');
            $table->string('description', 255);
            $table->string('siaf_number', 50)->nullable();
            $table->string('tracking_number', 50)->nullable();
            $table->unsignedBigInteger('order_number')->nullable();
            $table->string('pecosa_number', 50)->nullable();
            $table->text('details');
            $table->string('situation', 255);
            $table->decimal('executed_amount', 10, 2);
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
        Schema::dropIfExists('project_concepts');
    }
};

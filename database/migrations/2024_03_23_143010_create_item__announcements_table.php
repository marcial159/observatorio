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
        Schema::create('item__announcements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('announcement_id');
            $table->foreign('announcement_id')->references('id')->on('announcements');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->decimal('percent_min',5,2);
            $table->decimal('percent_max',5,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.z|
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item__announcements');
    }
};

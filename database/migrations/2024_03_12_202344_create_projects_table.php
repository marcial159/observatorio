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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100);
            $table->string('title', 255);
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('project_stages');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('project_categories');
            $table->unsignedBigInteger('contest_id');
            $table->foreign('contest_id')->references('id')->on('contests');
            $table->decimal('budget', 10, 2);
            $table->string('resolution', 255);
            $table->datetime('resolution_issuance');
            $table->datetime('start_schedule');
            $table->datetime('end_schedule');
            $table->string('general_objective', 255);
            $table->text('specific_objectives');
            $table->unsignedBigInteger('advisor_id');
            $table->foreign('advisor_id')->references('id')->on('users');
            $table->string('laboratory_observation')->nullable();
            $table->string('laboratory_production')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->unsignedBigInteger('monitor_id')->nullable();
            $table->foreign('monitor_id')->references('id')->on('users');

            $table->integer('progress')->default(0);

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
        Schema::dropIfExists('projects');
    }
};

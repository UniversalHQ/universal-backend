<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('war_data', function (Blueprint $table) {
            $table->id();

            $table->uuid('warId');
            $table->integer('warNumber');
            $table->integer('requiredVictoryTowns');
            $table->string('winner')->nullable();
            $table->unsignedBigInteger('conquestStartTime')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->unsignedBigInteger('conquestEndTime')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->unsignedBigInteger('resistanceStartTime')->nullable();
            $table->dateTime('resistance_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('war_data');
    }
}

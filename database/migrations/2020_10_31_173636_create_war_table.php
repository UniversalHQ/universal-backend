<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wars', function (Blueprint $table) {
            $table->id();

            $table->uuid('war_id');
            $table->integer('war_number');
            $table->integer('required_victory_towns');
            $table->string('winner')->nullable();

            $table->unsignedBigInteger('conquest_start_time');
            $table->dateTime('started_at')->nullable();
            $table->unsignedBigInteger('conquest_end_time')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->unsignedBigInteger('resistance_start_time')->nullable();
            $table->dateTime('resistance_at')->nullable();

            $table->text('active_tiles_string')->nullable();
            $table->text('active_resistance_tiles_string')->nullable();

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
        Schema::dropIfExists('wars');
    }
}

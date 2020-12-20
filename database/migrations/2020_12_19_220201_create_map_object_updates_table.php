<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapObjectUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_object_updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('map_object_id');

            $table->string('team_id')->nullable();
            $table->integer('icon_type')->nullable();
            $table->string('object_type')->nullable();
            $table->boolean('is_scorched')->nullable();
            $table->boolean('is_victory_base')->nullable();
            $table->boolean('is_build_site')->nullable();

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
        Schema::dropIfExists('map_object_events');
    }
}

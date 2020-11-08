<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapWarReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_war_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('map_id');
            $table->unsignedBigInteger('war_id');

            $table->string('name');
            $table->integer('totalEnlistments');
            $table->integer('colonialCasualties');
            $table->integer('wardenCasualties');
            $table->integer('dayOfWar');
            $table->integer('version');

            $table->softDeletes();
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
        Schema::dropIfExists('map_war_reports');
    }
}

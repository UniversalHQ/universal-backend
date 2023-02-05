<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_objects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Map::class);
            $table->foreignIdFor(\App\Models\War::class);

            $table->string('team_id')->default('NONE');
            $table->string('text');

            $table->string('object_type');
            $table->integer('icon_type');

            $table->boolean('is_scorched')->default(false);
            $table->boolean('is_victory_base')->default(false);
            $table->boolean('is_build_site')->default(false);

            $table->decimal('x', 12, 10);
            $table->decimal('y', 12, 10);
            $table->decimal('lat',17,14);
            $table->decimal('lng',17,14);

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
        Schema::dropIfExists('map_objects');
    }
}

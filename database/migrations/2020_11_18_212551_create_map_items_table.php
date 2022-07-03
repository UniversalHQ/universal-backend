<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Map::class);
            $table->unsignedBigInteger('map_object_id')->nullable();

            $table->string('team_id');
            $table->integer('icon_type');
            $table->integer('flags');
            $table->decimal('x',12,10);
            $table->decimal('y',12,10);

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
        Schema::dropIfExists('map_items');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapTextItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_text_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Map::class);

            $table->string('text');
            $table->string('map_marker_type');
            $table->decimal('x',12,10);
            $table->decimal('y',12,10);
            $table->decimal('lat',13,10);
            $table->decimal('lng',13,10);

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
        Schema::dropIfExists('map_text_items');
    }
}

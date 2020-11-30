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
            $table->unsignedBigInteger('map_id');

            $table->string('text');
            $table->string('map_marker_type');
            $table->decimal('x',10,8);
            $table->decimal('y',10,8);
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

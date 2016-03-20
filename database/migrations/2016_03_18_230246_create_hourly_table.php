<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHourlyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourly', function (Blueprint $table) {
            // ID of history entry.
            $table->increments('id');
            // Node id.
            $table->integer('node_id');
            // Temperature.
            $table->integer('temperature');
            // Pressure.
            $table->integer('pressure');
            // Humidity.
            $table->integer('humidity');
            // Time...
            $table->timestamp('added_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop the hourly table >:(
        Schema::dropIfExists('hourly');
    }
}

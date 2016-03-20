<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            // TODO: Maybe implement GUID for scalability?
            // $table->uuid('id');
            $table->increments('id');
            // Create IP property. 39 is IPv6 max size, which fits IPv4 (common sense.)
            $table->char('ip', 39);
            // Name of the server.
            $table->char('name', 20);
            // Description of the server.
            $table->mediumText('description');
            // MOTD
            $table->mediumText('motd');
            // Region of server.
            $table->char('region', 50);
            // Timezone of server, e.g. Americas/Puerto_Rico
            $table->char('timezone', 80);
            // Lat/Long, values rounded to 6.
            $table->integer('latitude');
            $table->integer('longitude');
            // Time
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
        // Drop the table. *sniffs*
        Schema::dropIfExists('nodes');
    }
}

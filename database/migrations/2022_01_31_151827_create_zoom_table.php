<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('zoomid');
            $table->string('host');
            $table->string('taskhashid')->nullable();
            $table->string('roomnum')->nullable();
            $table->string('joiner')->nullable();
            $table->timestamp('start');
            $table->string('duration');
            $table->longText('starturl');
            $table->longText('joinurl');
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
        Schema::dropIfExists('zoom');
    }
}

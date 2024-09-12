<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->longText('description')->nullable();
            $table->longText('starturl');
            $table->longText('joinurl');
            $table->string('semtype_id');
            $table->string('open');
            $table->string('fee');
            $table->integer('limit');
            $table->string('passcode');
            $table->string('formurl')->nullable();
            $table->longText('zoomapi')->nullable();
            $table->foreignId('host_id');
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
        Schema::dropIfExists('seminars');
    }
}

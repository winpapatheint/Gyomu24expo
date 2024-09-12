<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testid');
            $table->foreignId('tester');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->longText('answer')->nullable();
            $table->string('status')->default('0');
            $table->string('result')->nullable();
            $table->integer('getmark')->nullable();
            $table->integer('fullmark')->nullable();
            $table->timestamp('submittime')->nullable();

            // $table->longText('joinurl');
            // $table->string('semtype_id');
            // $table->string('open');
            // $table->string('fee');
            // $table->integer('limit');
            // $table->string('passcode');
            // $table->longText('zoomapi')->nullable();
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
        Schema::dropIfExists('test');
    }
}

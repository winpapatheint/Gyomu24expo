<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fid');
            $table->foreignId('testid');
            $table->foreignId('created_by');
            $table->string('qid');
            $table->string('name');
            $table->string('qtype');
            $table->string('ansformat');
            $table->integer('mark');
            $table->longText('instruction')->nullable();
            $table->longText('content')->nullable();
            $table->string('contentimg')->nullable();
            $table->string('contentmp3')->nullable();
            $table->longText('question')->nullable();
            $table->string('questionimg')->nullable();
            $table->string('questionmp3')->nullable();
            $table->string('ans1')->nullable();
            $table->string('ans2')->nullable();
            $table->string('ans3')->nullable();
            $table->string('ans4')->nullable();
            $table->string('ans5')->nullable();
            $table->string('correctans')->nullable();
            $table->longText('howtowrite')->nullable();
            $table->string('del')->default('0');
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
        Schema::dropIfExists('fixques');
    }
}

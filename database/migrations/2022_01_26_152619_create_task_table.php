<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('hashid')->nullable();
            $table->string('name');
            $table->string('status')->default('1');
            $table->foreignId('user');
            $table->foreignId('subadmin')->nullable();
            $table->json('influencer')->nullable();
            $table->string('moneyin')->nullable();

            $table->string('deliveryperiod');
            $table->string('contactmethod');
            $table->string('budget');
            $table->longText('description')->nullable();
            $table->string('infcgender')->nullable();
            $table->string('infccountry')->nullable();

            $table->string('price')->nullable();
            $table->string('paypal')->nullable();

            $table->string('zoomid')->nullable();
            $table->string('zoomstart')->nullable();
            $table->string('zoomjoin')->nullable();

            $table->longText('infoproduct')->nullable();
            $table->longText('infodetail')->nullable();
            $table->string('infoduration')->nullable();
            $table->string('infokpi')->nullable();
            $table->string('infoconsiderreward')->nullable();
            $table->string('infoneedreward')->nullable();
            $table->string('infobreakdown')->nullable();
            $table->string('infosupplement')->nullable();
            $table->string('infoestimatedtime')->nullable();
            $table->string('infodeadine')->nullable();

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
        Schema::dropIfExists('task');
    }
}

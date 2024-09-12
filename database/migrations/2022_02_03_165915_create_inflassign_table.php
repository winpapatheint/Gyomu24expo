<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInflassignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inflassign', function (Blueprint $table) {
            $table->id();
            $table->string('taskid');
            $table->string('inflid');
            $table->string('inflstatus')->nullable();
            $table->string('moneyout')->nullable();
            $table->timestamp('paydone')->nullable();
            $table->string('reporttitle')->nullable();
            $table->longText('reportbody')->nullable();
            $table->timestamp('reportupdated_at')->nullable();
            $table->string('reportupdated_by')->nullable();
            $table->timestamp('reportsubmitted_at')->nullable();
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
        Schema::dropIfExists('inflassign');
    }
}

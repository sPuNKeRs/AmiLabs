<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TODO:: Пересмотреть типы данных
        Schema::create('research_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_researh_id');
            $table->integer('analysis_id');
            $table->string('result')->nullable();
            $table->string('pay')->nullable();
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
        Schema::dropIfExists('research_results');
    }
}

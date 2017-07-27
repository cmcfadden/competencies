<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('primary_competency_id')->unsigned()->nullable();
            $table->foreign('primary_competency_id')->references('id')->on('competencies');
            $table->integer('experience');
            $table->boolean('completed');
            $table->boolean('classic_rate')->default(false);
            $table->timestamps();
        });

        Schema::create('competency_rate_response', function(Blueprint $table)
        {
            $table->integer('competency_id')->unsigned()->nullable();
            $table->foreign('competency_id')->references('id')
            ->on('competencies')->onDelete('cascade');

            $table->integer('rate_response_id')->unsigned()->nullable();
            $table->foreign('rate_response_id')->references('id')
            ->on('rate_responses')->onDelete('cascade');

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
        Schema::dropIfExists('competency_rate_response');
        Schema::dropIfExists('rate_responses');
        
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrimaryCompetency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rate_responses', function (Blueprint $table) {
            $table->renameColumn('competency_id', 'primaryCompetency');
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
        Schema::table('rate_responses', function (Blueprint $table) {
            $table->renameColumn('primaryCompetency','competency_id');
        });

        Schema::dropIfExists('competency_rate_response');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('competency_id')->unsigned();
            $table->foreign("competency_id")->references('id')->on("competencies");
            $table->integer('level')->unsigned();
            $table->timestamps();
        });

        Schema::create('evaluation_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evaluation_id')->unsigned();
            $table->foreign("evaluation_id")->references('id')->on("evaluations");
            $table->integer('descriptor_id')->unsigned();
            $table->foreign("descriptor_id")->references('id')->on("descriptors");
            $table->integer('response')->unsigned();
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
        Schema::dropIfExists('evaluation_entries');
        Schema::dropIfExists('evaluations');
    }
}

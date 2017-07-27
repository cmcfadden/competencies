<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rateassignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('active');
            $table->text("assignment_title");
            $table->text("target_email");
            $table->timestamps();
        });

        Schema::table('rate_responses', function (Blueprint $table) {
            $table->integer("rate_assignment")->unsigned()->nullable();
            $table->foreign("rate_assignment")->references("id")->on("rate_responses");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rate_assignments');
        Schema::table('rate_responses', function (Blueprint $table) {
            $table->dropForeign("rate_responses_rate_assignment_foreign");
            $table->dropColumn("rate_assignment");
        });
    }
}

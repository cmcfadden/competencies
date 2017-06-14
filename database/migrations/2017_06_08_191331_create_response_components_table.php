<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_components', function (Blueprint $table) {
            $table->increments('id');
            $table->string("response_type");
            $table->integer("response_modality");
            $table->text("response_text");
            $table->string("video_id");
            $table->integer("response_id")->unsigned();
            $table->foreign("response_id")->references('id')->on("rate_responses");
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
        Schema::dropIfExists('response_components');
    }
}

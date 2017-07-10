<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptor_traits', function (Blueprint $table) {
            $table->increments('id');
            $table->string("trait_title");
            $table->integer("competency_id")->unsigned();
            $table->foreign("competency_id")->references('id')->on("competencies");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descriptor_traits');
    }
}

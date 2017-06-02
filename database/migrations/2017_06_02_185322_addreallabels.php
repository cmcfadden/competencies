<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addreallabels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competencies', function (Blueprint $table) {
            $table->integer('official_order');
            $table->string('intro_animation_url');
            $table->string('icon_url');
        });

        Schema::table('descriptors', function (Blueprint $table) {
            $table->string('descriptor_as_question');
            $table->integer('trait')->unsigned();
            $table->foreign("trait")->references('id')->on("descriptor_traits");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competencies', function (Blueprint $table) {
            $table->dropColumn('official_order');
            $table->dropColumn('intro_animation_url');
            $table->dropColumn('icon_url');
        });

        Schema::table('descriptors', function (Blueprint $table) {
            $table->dropColumn('descriptor_as_question');
        });
    }
}

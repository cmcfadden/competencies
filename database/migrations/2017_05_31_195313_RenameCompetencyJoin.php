<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCompetencyJoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descriptor_traits', function (Blueprint $table) {
            $table->dropForeign(['competency']);
            $table->renameColumn('competency', 'competency_id');
            $table->foreign("competency_id")->references('id')->on("competencies");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('descriptor_traits', function (Blueprint $table) {
            $table->dropForeign(['competency_id']);
            $table->renameColumn('competency_id', 'competency');
            $table->foreign("competency")->references('id')->on("competencies");
        });
    }
}

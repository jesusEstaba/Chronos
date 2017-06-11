<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRealtionModifiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modifiers', function (Blueprint $table) {
            $table->integer('projectId')->unsigned();
            $table->foreign('projectId')
                  ->references('id')
                  ->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modifiers', function (Blueprint $table) {
            $table->dropColumn('projectId');
        });
    }
}

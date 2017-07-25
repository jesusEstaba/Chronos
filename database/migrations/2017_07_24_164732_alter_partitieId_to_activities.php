<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPartitieIdToActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign('activities_partitieid_foreign');
        });

        
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('partitieId');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->integer('partitieId')->unsigned();
            $table->foreign('partitieId')
                  ->references('id')
                  ->on('project_partities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            //
        });
    }
}

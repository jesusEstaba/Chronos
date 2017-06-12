<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRelationshipProjectResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_materials', function (Blueprint $table) {
            $table->integer('partitieId')->unsigned();
            $table->foreign('partitieId')
                  ->references('id')
                  ->on('project_partities');
        });

        Schema::table('project_equipments', function (Blueprint $table) {
            $table->integer('partitieId')->unsigned();
            $table->foreign('partitieId')
                  ->references('id')
                  ->on('project_partities');
        });
        
        Schema::table('project_workforces', function (Blueprint $table) {
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
        //
    }
}

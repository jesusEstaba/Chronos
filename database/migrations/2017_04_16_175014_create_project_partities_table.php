<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectPartitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_partities', function (Blueprint $table) {
            $table->increments('id');

            $table->float('yield');
            $table->float('quantity');

            $table->integer('projectId')->unsigned();
            $table->foreign('projectId')
                  ->references('id')
                  ->on('projects');

            $table->integer('partitieId')->unsigned();
            $table->foreign('partitieId')
                  ->references('id')
                  ->on('partities');

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
        Schema::dropIfExists('project_partities');
    }
}

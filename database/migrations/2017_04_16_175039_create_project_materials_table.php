<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_materials', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('partitieId')->unsigned();
            $table->foreign('partitieId')
                  ->references('id')
                  ->on('partities');

            $table->integer('materialId')->unsigned();
            $table->foreign('materialId')
                  ->references('id')
                  ->on('materials');

            $table->integer('costId')->unsigned();
            $table->foreign('costId')
                  ->references('id')
                  ->on('material_costs');

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
        Schema::dropIfExists('project_materials');
    }
}

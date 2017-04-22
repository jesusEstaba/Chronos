<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_equipments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('partitieId')->unsigned();
            $table->foreign('partitieId')
                  ->references('id')
                  ->on('partities');

            $table->integer('equipmentId')->unsigned();
            $table->foreign('equipmentId')
                  ->references('id')
                  ->on('equipments');

            $table->integer('costId')->unsigned();
            $table->foreign('costId')
                  ->references('id')
                  ->on('equipment_costs');

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
        Schema::dropIfExists('project_equipments');
    }
}

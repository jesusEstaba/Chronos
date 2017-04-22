<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_costs', function (Blueprint $table) {
            $table->increments('id');

            $table->double('cost');

            $table->integer('equipmentId')->unsigned();
            $table->foreign('equipmentId')
                  ->references('id')
                  ->on('equipments');

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
        Schema::dropIfExists('equipment_costs');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('companieId')->unsigned();
            $table->foreign('companieId')
                  ->references('id')
                  ->on('companies');

            $table->integer('unitId')->unsigned();
            $table->foreign('unitId')
                  ->references('id')
                  ->on('units');

            $table->integer('categoryId')->unsigned();
            $table->foreign('categoryId')
                  ->references('id')
                  ->on('categories');

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
        Schema::dropIfExists('materials');
    }
}

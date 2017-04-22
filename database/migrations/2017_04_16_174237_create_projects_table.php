<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->date('start');
            $table->date('end');
            $table->date('finish');

            $table->integer('companieId')->unsigned();
            $table->foreign('companieId')
                  ->references('id')
                  ->on('companies');

            $table->integer('clientId')->unsigned();
            $table->foreign('clientId')
                  ->references('id')
                  ->on('clients');

            $table->integer('stateId')->unsigned();
            $table->foreign('stateId')
                  ->references('id')
                  ->on('states');

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
        Schema::dropIfExists('projects');
    }
}

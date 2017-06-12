<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectWorkforcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_workforces', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('workforceId')->unsigned();
            $table->foreign('workforceId')
                  ->references('id')
                  ->on('workforces');

            $table->integer('costId')->unsigned();
            $table->foreign('costId')
                  ->references('id')
                  ->on('workforce_costs');

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
        Schema::dropIfExists('project_workforces');
    }
}

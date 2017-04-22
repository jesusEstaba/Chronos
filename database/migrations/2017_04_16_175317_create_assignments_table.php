<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('activityId')->unsigned();
            $table->foreign('activityId')
                  ->references('id')
                  ->on('activities');

            $table->integer('employeeId')->unsigned();
            $table->foreign('employeeId')
                  ->references('id')
                  ->on('employees');

            $table->integer('workforceId')->unsigned();
            $table->foreign('workforceId')
                  ->references('id')
                  ->on('workforces');

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
        Schema::dropIfExists('assignments');
    }
}

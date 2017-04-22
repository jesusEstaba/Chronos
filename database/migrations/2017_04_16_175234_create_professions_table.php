<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('employeeId')->unsigned();
            $table->foreign('employeeId')
                  ->references('id')
                  ->on('employees');

            $table->integer('workforceId')->unsigned();
            $table->foreign('workforceId')
                  ->references('id')
                  ->on('workforces');


            $table->integer('companieId')->unsigned();
            $table->foreign('companieId')
                  ->references('id')
                  ->on('companies');

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
        Schema::dropIfExists('professions');
    }
}

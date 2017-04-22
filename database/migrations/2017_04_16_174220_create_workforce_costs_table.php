<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkforceCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workforce_costs', function (Blueprint $table) {
            $table->increments('id');
            
            $table->double('cost');

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
        Schema::dropIfExists('workforce_costs');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * @todo remove default(1) in final version.
         * this is only fix for DB with data
         */
        Schema::table('units', function (Blueprint $table) {
            $table->integer('companieId')
                ->default(1)
                ->unsigned();
            $table->foreign('companieId')
                  ->references('id')
                  ->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            //
        });
    }
}

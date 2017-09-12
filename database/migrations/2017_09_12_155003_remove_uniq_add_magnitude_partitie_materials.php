<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUniqAddMagnitudePartitieMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partitie_materials', function (Blueprint $table) {
            $table->dropColumn('uniq');
            $table->boolean('magnitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partitie_materials', function (Blueprint $table) {
            //
        });
    }
}

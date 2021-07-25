<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRegionIdAndTownshipIdNullableToAmbulancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ambulances', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->nullable()->change();
            $table->unsignedBigInteger('township_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ambulances', function (Blueprint $table) {
            //
        });
    }
}

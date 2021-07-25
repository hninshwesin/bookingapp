<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionIdAndTownshipIdToLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labs', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->index();
            $table->unsignedBigInteger('township_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labs', function (Blueprint $table) {
            //
        });
    }
}

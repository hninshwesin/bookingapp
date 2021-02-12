<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagetreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagetreatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id')->index();
            $table->string('name');
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->string('files')->nullable();
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
        Schema::dropIfExists('imagetreatments');
    }
}

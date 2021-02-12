<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurtherplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furtherplans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id')->index();
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->string('Further_plan')->nullable();;
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
        Schema::dropIfExists('furtherplans');
    }
}

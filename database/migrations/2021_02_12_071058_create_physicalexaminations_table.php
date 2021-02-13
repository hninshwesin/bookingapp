<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalexaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physicalexaminations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id')->index();
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->string('General_Condition')->nullable();
            $table->string('Anaemia')->nullable();
            $table->string('Jaundice')->nullable();
            $table->string('Temperature')->nullable();
            $table->string('BP')->nullable();
            $table->string('PR')->nullable();
            $table->string('Heart')->nullable();
            $table->string('Lungs')->nullable();
            $table->string('Abdomen')->nullable();
            $table->string('Others')->nullable();
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
        Schema::dropIfExists('physicalexaminations');
    }
}

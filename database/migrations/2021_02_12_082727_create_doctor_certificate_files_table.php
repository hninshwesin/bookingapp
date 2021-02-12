<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorCertificateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_certificate_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id')->index();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('name');
            $table->string('certificate_file');
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
        Schema::dropIfExists('doctor_certificate_files');
    }
}

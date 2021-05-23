<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorPatientLastMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_patient_last_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_user_doctor_id')->index();
            $table->unsignedBigInteger('app_user_patient_id')->index();
            $table->text('last_message');
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
        Schema::dropIfExists('doctor_patient_last_messages');
    }
}

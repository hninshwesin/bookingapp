<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorUnreadStatusAndPatientUnreadStatusToDoctorPatientLastMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_patient_last_messages', function (Blueprint $table) {
            $table->bigInteger('doctor_unread_status')->default('0');
            $table->bigInteger('patient_unread_status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_patient_last_messages', function (Blueprint $table) {
            //
        });
    }
}

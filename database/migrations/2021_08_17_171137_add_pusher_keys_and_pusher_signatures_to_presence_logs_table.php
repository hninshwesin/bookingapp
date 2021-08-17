<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPusherKeysAndPusherSignaturesToPresenceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presence_logs', function (Blueprint $table) {
            $table->string('pusher_key');
            $table->string('pusher_signature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presence_logs', function (Blueprint $table) {
            //
        });
    }
}

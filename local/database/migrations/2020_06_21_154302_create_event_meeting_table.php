<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_meeting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longtext('start_url');
            $table->longtext('join_url');
            $table->string('meeting_id');
            $table->string('meeting_password');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('event_id');
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
        Schema::dropIfExists('event_meeting');
    }
}

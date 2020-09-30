<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("event_id")->unsigned();
            $table->foreign('event_id')->references('id')->on('event');
            $table->unsignedInteger("ticket_type_id")->nullable();
            $table->foreign('ticket_type_id')->references('id')->on('ticket_type');
            $table->string("ticket_no");
            $table->integer("status")->default(0);
            $table->integer("employee_id")->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('event_ticket');
    }
}

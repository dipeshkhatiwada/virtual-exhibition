<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("event_id")->unsigned();
            $table->foreign('event_id')->references('id')->on('event');
            $table->integer("employee_id")->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->integer('employers_id')->unsigned()->nullable();
            $table->foreign('employers_id')->references('employers_id')->on('employer_user');
            $table->longtext('review');
            $table->integer('rating')->unsigned();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
}

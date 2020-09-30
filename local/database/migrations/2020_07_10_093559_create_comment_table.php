<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("event_id")->unsigned();
            $table->foreign('event_id')->references('id')->on('event');
            $table->integer("employee_id")->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->integer('employers_id')->unsigned()->nullable();
            $table->foreign('employers_id')->references('employers_id')->on('employer_user');
            $table->longtext('comment');
            $table->integer('parent_id')->nullable();
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
        Schema::dropIfExists('comment');
    }
}

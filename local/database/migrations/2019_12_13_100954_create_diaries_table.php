<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('diary', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('staff_id')->unsigned()->index();
        //     $table->foreign('staff_id')->references('id')->on('employees')->onDelete('cascade');
        //     $table->string('title')->nullable();
        //     $table->text('description')->nullable();
        //     $table->date('date')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('diary');
    }
}

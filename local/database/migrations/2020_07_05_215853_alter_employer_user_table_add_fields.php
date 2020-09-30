<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEmployerUserTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employer_user', function (Blueprint $table) {
            $table->string('employer_bank_name')->nullable()->after('email');
            $table->string('employer_account_number')->nullable()->after('employer_bank_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employer_user', function (Blueprint $table) {
            $table->dropColumn(['employer_account_number', 'employer_bank_name']);
        });
    }
}

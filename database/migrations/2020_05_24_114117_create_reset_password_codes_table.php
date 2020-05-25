<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResetPasswordCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reset_password_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->foreign('email')->references('email')->on('users');
            $table->string('student_ref');
            $table->foreign('student_ref')->references('student_ref')->on('users');
            $table->string('reset_code')->unique();
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
        Schema::dropIfExists('reset_password_codes');
    }
}

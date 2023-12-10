<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique()->nullable();
            $table->string('district_name')->nullable();
            $table->string('School_name')->nullable();
            $table->string('student_status')->default('guest');
            $table->string('teacher_status')->default('inactive');
            $table->string('manager_status')->default('inactive');
            $table->string('admin_status')->default('inactive');
            $table->string('total_student')->nullable();
            $table->string('total_like')->nullable();
            $table->string('total_quiz')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

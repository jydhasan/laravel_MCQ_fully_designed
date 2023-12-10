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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->nullable();
            $table->string('quiz_table_name')->nullable();
            $table->string('quiz_result_table_name')->nullable();
            $table->string('quiz_time')->nullable();
            $table->string('quiz_title')->nullable();
            $table->string('quiz_description')->nullable();
            $table->string('quiz_notice')->nullable();
            $table->string('quiz_subject')->nullable();
            $table->string('quiz_live_status')->nullable();
            $table->string('file_type')->nullable();
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
        Schema::dropIfExists('boxes');
    }
};

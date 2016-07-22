<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackCodesPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_codes_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feedback_id')->unsigned();
            $table->integer('code_id')->unsigned();
            $table->timestamps();
            $table->foreign('feedback_id')->references('id')->on('bug_reports')->onDelete('cascade');
            $table->foreign('code_id')->references('id')->on('store_feedback_codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feedback_codes_pivot');
    }
}

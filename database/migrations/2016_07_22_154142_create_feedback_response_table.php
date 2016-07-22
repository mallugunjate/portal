<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_response', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feedback_id')->unsigned();
            $table->boolean('closed');
            $table->boolean('followed_up');
            $table->timestamps();
            $table->foreign('feedback_id')->references('id')->on('bug_reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feedback_response');
    }
}

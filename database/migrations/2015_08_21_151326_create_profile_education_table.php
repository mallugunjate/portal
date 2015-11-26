<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_education', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->string('focus', 255);
            $table->integer('education_level_id')->unsigned();
            $table->string('education_start');
            $table->string('education_end');
            $table->string('school_name');
            $table->timestamps();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('education_level_id')->references('id')->on('education_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile_education');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_activities', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->string('start', 10); //Unix timestamp
            $table->string('finished', 10);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('activity_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile_activities');
    }
}

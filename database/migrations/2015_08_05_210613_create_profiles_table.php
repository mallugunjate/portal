<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->string('fullname', 255);
            $table->integer('store_id')->unsigned();
            $table->integer('position_id')->unsigned();
            $table->boolean('ulead');
            $table->integer('five_factors');
            $table->integer('tribal_customs');
            $table->integer('leadership_brand');
            $table->integer('move_distance_id')->unsigned();
            $table->integer('career_path_id')->unsigned();
            $table->string('photo', 255);
            $table->integer('employee_id')->unsigned();
            $table->integer('manager_id')->unsigned();
            $table->integer('approved_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('move_distance_id')->references('id')->on('moves')->onDelete('cascade');
            $table->foreign('career_path_id')->references('id')->on('career_paths')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}

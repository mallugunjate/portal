<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_history', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->string('start_date', 10); //UNIX timestamp
            $table->string('end_date', 10);
            $table->integer('store_id')->unsigned();
            $table->integer('position_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile_history');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoodMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hood_members', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('hood_id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->boolean('hood_admin');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('hood_id')->references('id')->on('hoods')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hood_members');
    }
}

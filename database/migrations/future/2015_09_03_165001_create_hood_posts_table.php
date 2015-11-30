<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoodPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hood_posts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('hood_id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->longText('post_content');
            $table->boolean('has_media');
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
        Schema::drop('hood_posts');
    }
}

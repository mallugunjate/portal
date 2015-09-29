<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folders', function ($table) {
            $table->boolean('is_child');
            $table->boolean('has_weeks')->after('is_child');
            $table->integer('week_window_size')->after('has_weeks');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function ($table) {
            $table->dropColumn('is_child');
            $table->dropColumn('has_weeks');
            $table->dropColumn('week_window_size');
        });
    }
}

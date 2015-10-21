<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table("documents", function ($table) {
            $table->string('start');
            $table->string('end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table("documents", function ($table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}

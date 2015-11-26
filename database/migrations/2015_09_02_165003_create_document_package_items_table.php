<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentPackageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_package_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('document_package_id')->unsigned();
            $table->integer('document_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('document_package_id')->references('id')->on('document_package')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('document_package_items');
    }
}

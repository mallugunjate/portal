<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('store_number');
            $table->string('submitted_by');
            $table->string('event_name');
            $table->string('event_date');
            $table->integer('donation_type')->references('id')->on('audit_donation_types');
            $table->float('amount', 8, 2);
            $table->integer('sport')->references('id')->on('audit_sports');
            $table->integer('banner_id')->unsigned();
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

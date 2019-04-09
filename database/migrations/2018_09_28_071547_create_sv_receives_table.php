<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSvReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sv_receives', function (Blueprint $table) {
            $table->increments('idsv_receive');
            $table->bigInteger('idcustomer');
            $table->bigInteger('idsv_post');
            $table->text('result');
            $table->integer('idcampaign');
            $table->string('ip_address');
            $table->string('mac_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sv_receives');
    }
}

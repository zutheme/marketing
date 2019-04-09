<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSvSendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sv_sends', function (Blueprint $table) {
            $table->increments('idsv_send');
            $table->bigInteger('idcustomer');
            $table->bigInteger('idsv_post');
            $table->bigInteger('id_user');
            $table->integer('idcampaign');
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
        Schema::dropIfExists('sv_sends');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_products', function (Blueprint $table) {
            $table->increments('idexp');
            $table->bigInteger('idproduct');
            $table->integer('idcustomer');
            $table->integer('idemp');
            $table->integer('amount');
            $table->integer('price');
            $table->integer('note');
            $table->integer('idagency');
            $table->integer('idtypeimp');
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
        Schema::dropIfExists('exp_products');
    }
}

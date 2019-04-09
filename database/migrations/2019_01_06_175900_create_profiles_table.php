<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('profiles', function (Blueprint $table) {
            $table->increments('idprofile');
            $table->integer('iduser')->unique();
            $table->integer('idemployee')->unique();
            $table->string('firstname')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('idfile_avatar')->nullable();
            $table->integer('idposition')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}

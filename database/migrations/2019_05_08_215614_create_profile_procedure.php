<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE PROCEDURE CreateProfileProcedure(in _iduser int,in _firstname varchar(255),in _middlename varchar(255),in _lastname varchar(255),in _address varchar(255),in _mobile varchar(255),in _about varchar(255),in _facebook varchar(255),in _zalo varchar(255),in _url_avatar varchar(255))
            BEGIN
                insert into profile(iduser,firstname,middlename,lastname,address,mobile,about,facebook ,zalo,url_avatar) values (_iduser,_firstname,_middlename,_lastname,_address,_mobile,_about,_facebook ,_zalo,_url_avatar);
                    SELECT LAST_INSERT_ID() as idprofile; 
            END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CreateProfileProcedure');
    }
}

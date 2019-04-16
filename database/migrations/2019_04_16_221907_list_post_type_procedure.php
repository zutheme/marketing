<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ListPostTypeProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE PROCEDURE ListPostTypeByIdcatProcedure(IN _idcat int)
        BEGIN
        IF _idcat > 0 THEN
        BEGIN
           SELECT * FROM post_types WHERE idparent = _idcat;
        END; 
        ELSE
        BEGIN
           SELECT * FROM post_types;    
        END;
        END IF;
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ListPostTypeByIdcatProcedure');
    }
}

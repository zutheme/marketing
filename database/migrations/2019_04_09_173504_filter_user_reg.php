<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilterUserReg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('SET @now = DATE(NOW());
                        SET @str_start = CONCAT(@now," 00:00:00");
                        SET @start_date = STR_TO_DATE(@str_start,'%Y-%m-%d %H:%i:%s');
                        SET @_idcategory = 3;
                        SET @_id_post_type = 2;
                        SET @_id_status_type = 1;
                        SELECT cus.mobile,cus.firstname,cus.email,user_reg.body FROM (SELECT imp.iduser_imp,po.body FROM (SELECT im.* FROM (SELECT * FROM impposts WHERE created_at >= @start_date AND  created_at < NOW()) AS im WHERE im.id_status_type=@_id_status_type) AS imp JOIN
                        (SELECT pt.* FROM (SELECT p.* FROM (SELECT idpost,body,id_post_type,idcategory FROM posts WHERE created_at >= @start_date AND created_at < NOW()) AS p WHERE p.idcategory=@_idcategory) AS pt WHERE pt.id_post_type=@_id_post_type) AS po ON imp.idpost=po.idpost) AS user_reg JOIN
                        sv_customers AS cus ON user_reg.iduser_imp = cus.idcustomer');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS FilterUserReg');
    }
}

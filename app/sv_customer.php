<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class sv_customer extends Model

{

    protected $primaryKey = 'idcustomer';

    protected $fillable = ['firstname','lastname','email','mobile','address','job','note','created_at','updated_at'];

}


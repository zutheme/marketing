<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
     protected $primaryKey = 'idproduct';
     protected $fillable = ['name','discription','idtypeproduct','idcategory','created_at','updated_at'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
     protected $primaryKey = 'idprofile';
     protected $fillable = ['about','facebook','zalo','url_avatar','created_at','updated_at'];
}

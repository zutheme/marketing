<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $primaryKey = 'idposttype';
    protected $fillable = ['nametype','created_at','updated_at'];
}

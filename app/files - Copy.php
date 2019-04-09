<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    protected $primaryKey = 'idfile';
    protected $fillable = ['urlfile','namefile','typefile','created_at','updated_at'];
}

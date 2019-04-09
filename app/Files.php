<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $primaryKey = 'idfile';
    protected $fillable = ['urlfile','namefile','typefile','created_at','updated_at'];
}

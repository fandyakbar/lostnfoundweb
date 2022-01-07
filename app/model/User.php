<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    //
    protected $table='user';

    protected $fillable = [
        'email',
        'kontak',
        'password',
        'nama',
        'token',
      ];

}

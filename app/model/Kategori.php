<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table='kategori';

    protected $fillable = [
        'kategori',

    ];

    public function barang(){
        return $this->hasMany(Barang::class, 'id_kategori', 'id');
    }
}

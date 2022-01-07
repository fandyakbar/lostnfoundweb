<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;


class Barang extends Model
{
    //
    protected $table='barang';

    protected $fillable = [
        'nama_barang',
        'id_kategori',
        'id_penemu',
        'deskripsi',
        'gambar',
        'latitude',
        'longitude',
    ];

    public function kategori(){
        return $this->belongsTo(kategori::class, 'id_kategori', 'id');
    }
}

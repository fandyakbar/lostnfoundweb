<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;


class Barang extends Model
{
    //
    protected $table='barang';

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'id_kategori',
        'id_penemu',
        'deskripsi',
        'gambar',
        'lokasi',
        'latitude',
        'longitude',
    ];

    public function kategori(){
        return $this->belongsTo(kategori::class, 'id_kategori', 'id');
    }
}

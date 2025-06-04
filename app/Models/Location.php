<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Tentukan nama tabel di database
    protected $table = 'locations'; // Nama tabel di database

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'kelurahan_nama',
        'kecamatan_nama',
        'kota_nama',
        'provinsi_nama',
    ];

    // Menentukan bahwa model tidak menggunakan timestamp (jika tidak perlu)
    public $timestamps = false;
}

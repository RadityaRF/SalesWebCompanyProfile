<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';

    protected $fillable = [
        'nama_mobil',
        'jenis_mobil',
        'gambar_mobil',
        'harga_mulai',
    ];

}

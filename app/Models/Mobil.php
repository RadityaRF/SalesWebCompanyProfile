<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_mobil',
        'jenis_mobil',
        'gambar_mobil',
        'highlight',
        'deskripsi',
        'harga_mulai',
    ];

    // Relasi: satu Mobil punya banyak MobilTipe
    public function tipeMobil()
    {
        return $this->hasMany(MobilTipe::class, 'id_mobil', 'id');
    }

    // Relasi: satu Mobil punya banyak MobilFitur
    public function fiturMobil()
    {
        return $this->hasMany(MobilFitur::class, 'id_mobil', 'id');
    }

    // Relasi: satu Mobil punya banyak MobilWarna
    public function warnaMobil()
    {
        return $this->hasMany(MobilWarna::class, 'id_mobil', 'id');
    }
}

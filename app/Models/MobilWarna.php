<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilWarna extends Model
{
    use HasFactory;

    protected $table = 'mobil_warna';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_mobil',
        'warna_mobil',
        'gambar_warna_mobil',
    ];

    // Relasi: tipe ini milik satu Mobil
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id');
    }
}

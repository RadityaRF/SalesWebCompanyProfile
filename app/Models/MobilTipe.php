<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilTipe extends Model
{
    use HasFactory;

    protected $table = 'mobil_tipe';

    protected $fillable = [
        'id_mobil',
        'nama_tipe',
        'spesifikasi',
        'gambar_mobil_tipe',
        'harga_mobil',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil');
    }
}

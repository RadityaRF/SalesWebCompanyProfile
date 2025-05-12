<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilTipe extends Model
{
    use HasFactory;

    protected $table = 'mobil_tipe';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_mobil',
        'nama_tipe',
        'spesifikasi',
        'gambar_mobil_tipe',
        'harga_mobil',
    ];

    // Relasi: tipe ini milik satu Mobil
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id');
    }
}

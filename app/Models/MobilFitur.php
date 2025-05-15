<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilFitur extends Model
{
    use HasFactory;

    protected $table = 'mobil_fitur';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_mobil',
        'fitur_mobil',
        'gambar_fitur_mobil',
    ];

    // Relasi: tipe ini milik satu Mobil
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id');
    }
}

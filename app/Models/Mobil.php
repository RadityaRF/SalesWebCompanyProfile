<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'banner_mobil',
        'harga_mulai',
        'slug',
    ];

    /**
     * Use 'slug' instead of 'id' in route model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Auto-generate slug when creating or saving
     */
    protected static function booted()
    {
        static::saving(function ($mobil) {
            // Only generate slug if not manually set
            if (empty($mobil->slug)) {
                $mobil->slug = Str::slug($mobil->nama_mobil);
            }
        });
    }


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

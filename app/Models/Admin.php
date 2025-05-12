<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'id';
    public $timestamps = false; // atau true jika pakai created_at/updated_at

    protected $fillable = [
        'nama', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}

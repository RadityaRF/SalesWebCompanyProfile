<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
     protected $fillable = ['title', 'description', 'image_path', 'start_date', 'end_date'];

}

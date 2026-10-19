<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potensi extends Model
{
    use HasFactory;

        protected $fillable = [
        'name',
        'luas',
        'jen_tani',
        'kel_tani',
        'pendapatan',
        'alamat',
        'gambar',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    protected $fillable = [
        'gambar',
        'tanggal',
        'kategori',
        'ket',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}

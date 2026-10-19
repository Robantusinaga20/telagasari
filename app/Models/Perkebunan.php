<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkebunan extends Model
{
    use HasFactory;
    protected $table = 'perkebunans'; 

    protected $fillable = [
        'jen_tanaman',
        'luas',
        'jlh_panen',
        'gambar',
    ];
}

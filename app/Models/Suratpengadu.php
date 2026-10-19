<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratpengadu extends Model
{
    use HasFactory;

    protected $fillable = [
        'perihal',
        'nohp',
        'gambar',
        'name',
        'alamat',
        'lokasi',
        'deskripsi',
        'status',
    ];
}

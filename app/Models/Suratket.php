<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratket extends Model
{
    use HasFactory;

    protected $fillable = [
        'jen_surat',
        'perihal',
        'nohp',
        'email',
        'nik',
        'nokk',
        'gambar',
        'name',
        'alamat',
        'ket',
        'status',
    ];
}

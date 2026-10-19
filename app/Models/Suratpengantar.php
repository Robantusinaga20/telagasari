<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratpengantar extends Model
{
    use HasFactory;
    protected $fillable = [
        'jen_surat',
        'perihal',
        'nohp',
        'email',
        'name',
        'jen_kel',
        'tplahir',
        'tglahir',
        'agama',
        'stat',
        'pkerja',
        'alamat',
        'status',
    ];
}

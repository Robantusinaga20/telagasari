<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peternakan extends Model
{
    use HasFactory;
    protected $table = 'peternakans'; 

    protected $fillable = [
        'jen_ternak',
        'pop_ternak',
        'jlh_pemilik',
        'gambar',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrktDesa extends Model
{
    use HasFactory;

        protected $table = 'prktdesas'; 

    protected $fillable = [
        'name',
        'jabatan',
        'gambar',
    ];
}

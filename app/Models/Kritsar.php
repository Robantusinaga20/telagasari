<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kritsar extends Model
{
    use HasFactory;
    protected $fillable = [
        'kritik',
        'saran',
    ];
}

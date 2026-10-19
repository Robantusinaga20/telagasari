<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

        protected $fillable = [
        'jen_kerja',
        'jlh_lk',
        'jlh_pr',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Usia
 *
 * @property string $usia
 * @property int $jlh_lk
 * @property int $jlh_pr
 */
class Usia extends Model
{
    protected $fillable = ['usia', 'jlh_lk', 'jlh_pr'];
}

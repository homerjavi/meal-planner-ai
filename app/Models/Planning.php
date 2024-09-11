<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'family_id',
        'date_start',
        'date_end',
        'is_ia_generated',
        'is_favorite',
        'data',
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];
}

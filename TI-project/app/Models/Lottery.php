<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'balance',
        'start',
        'deadline',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

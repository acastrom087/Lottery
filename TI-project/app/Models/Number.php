<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    protected $fillable = [
        'lottery_id',
        'st_number',
        'nd_number',
        'rd_number',
    ];

    public function lottery()
    {
        return $this->belongsTo('App\Models\Lottery');
    }
}

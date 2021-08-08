<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lottery_id',
        'number',
        'bid',
    ];

    public function lottery()
    {
        return $this->belongsTo('App\Models\Lottery');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}

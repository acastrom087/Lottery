<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    protected $fillable = [
        'bid_id',
        'profit',
    ];

    public function bid()
    {
        return $this->belongsTo('App\Models\Bid');
    }
}

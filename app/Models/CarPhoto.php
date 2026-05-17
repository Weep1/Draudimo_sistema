<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarPhoto extends Model
{
    protected $fillable = [
        'car_id',
        'photo'
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

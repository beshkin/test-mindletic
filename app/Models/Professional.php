<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Professional extends Model
{
    use HasFactory;

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeAvailableOnTime($query, $timeStart, $timeEnd, $date){
        return static::bookings()
            ->where('start', $timeStart)
            ->where('end', $timeEnd)
            ->where('date', $date);
    }

    public static function isAvailable(string $timeStart, string $timeEnd, string $date){
        return static::availableOnTime($timeStart, $timeEnd, $date)->first() === null;
    }
}

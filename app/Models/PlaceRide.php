<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PlaceRide extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'driver_id',
        'amount',
        'departure',
        'destination',
        'takeoff_time',
        'available_seat',
        'remaining_seat',
        'ride_started',
        'ride_ended',
        'is_available',
        'date'
    ];

    public function Driver(){
        return $this->belongsTo(User::class);
    }

    public function bookings(){
        return $this->hasMany(Bookings::class);
    }

}

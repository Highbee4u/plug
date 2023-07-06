<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Bookings extends Model
{
    use HasFactory, HasUuids;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bookings(){
        return $this->belongsTo(PlaceRide::class);
    }

    protected $fillable = [

    ];
}

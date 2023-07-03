<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Vehicle extends Model
{
    use HasFactory, HasUuids;

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'brand',
        'colour',
        'registration_no',
        'car_model',
        'user_id',
        'air_condition',
        'manufacture_year',
        'body_type',
        'engine_no',
        'owners_name',
        'registration_status'

    ];
    
}

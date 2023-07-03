<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Liscence extends Model
{
    use HasFactory, HasUuids;

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'identification_no',
        'first_name',
        'last_name',
        'address',
        'registration_date',
        'liscence_class',
        'expiration_date',
        'meta'
    ];
}

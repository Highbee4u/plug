<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Account extends Model
{
    use HasFactory, HasUuids;

    public function user(){
        return $this->belongsTo(User::class); 
    }

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'user_id'
    ];
}

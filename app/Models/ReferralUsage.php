<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReferralUsage extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'referral_usages';
    
    protected $fillable = [
        'referer_user_id', 
        'referee_user_id',
        'transaction_volume',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
}

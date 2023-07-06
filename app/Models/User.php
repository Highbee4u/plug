<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Observers\User\UserObserver;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'has_car',
        'profile_status',
        'otp_verified',
        'recovery_mode',
        'is_disabled',
        'gender',
        'password',
        'passcode',
        'referal_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected static function booted()
    {
        self::observe(UserObserver::class);
    }

    public function Vehicle(){
        return $this->hasOne(Vehicle::class);
    }

    public function License(){
        return $this->hasOne(Liscence::class);
    }

    public function Transaction(){
        return $this->hasMany(Transaction::class);
    }

    public function Bookings(){
        return $this->hasMany(Bookings::class);
    }

    public function Account(){
        return $this->hasOne(Account::class);
    }

    public function placed_ride(){
        return $this->hasOne(PlaceRide::class);
    }
}

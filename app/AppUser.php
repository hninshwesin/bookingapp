<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class AppUser extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ambulances()
    {
        return $this->belongsToMany(Ambulance::class);
    }

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class);
    }

    public function labs()
    {
        return $this->belongsToMany(Lab::class);
    }

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}

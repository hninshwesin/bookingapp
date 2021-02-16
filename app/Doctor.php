<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Doctor extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    //    protected $guard = 'doctor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name', 'Qualifications', 'Contact_Number','Email','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }

    public function DoctorCertificateFile()
    {
        return $this->hasMany('App\DoctorCertificateFile');
    }
}

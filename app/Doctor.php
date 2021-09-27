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

    //  protected $guarded = [];
    protected $fillable = [
        'Name', 'Qualifications', 'Contact_Number', 'Email', 'available_time', 'other_option', 'sama_number', 'specialization', 'app_user_id', 'hide_my_info', 'approve_status', 'specialization_id'
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
        return $this->hasMany(DoctorCertificateFile::class);
    }

    public function visit()
    {
        return $this->hasOne(Visit::class);
    }

    public function DoctorProfilePicture()
    {
        return $this->hasOne(DoctorProfilePicture::class);
    }

    public function DoctorSamaFileOrNrcFile()
    {
        return $this->hasMany(DoctorSamaFileOrNrcFile::class);
    }

    public function app_user()
    {
        return $this->belongsTo(AppUser::class);
    }

    public function specialization()
    {
        return $this->belongsTo(specialization::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function app_users()
    {
        return $this->belongsToMany(AppUser::class);
    }

    public function patient_rating()
    {
        return $this->belongsToMany(Patient::class, 'doctor_patient_rating')->withPivot('rating');
    }
}

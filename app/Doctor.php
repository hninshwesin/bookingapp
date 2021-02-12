<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name', 'Qualifications', 'Contact_Number','Email'
    ];

    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }

    public function DoctorCertificateFile()
    {
        return $this->hasMany('App\DoctorCertificateFile');
    }
}

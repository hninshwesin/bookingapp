<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'app_user_patient_id', 'app_user_doctor_id', 'total_amount', 'to_doctor_amount', 'to_admin_amount'
    ];

    public function app_user_patient()
    {
        return $this->belongsTo(AppUser::class, 'app_user_patient_id');
    }

    public function app_user_doctor()
    {
        return $this->belongsTo(AppUser::class, 'app_user_doctor_id');
    }

    // public function doctor()
    // {
    //     return $this->belongsTo(Doctor::class, 'app_user_doctor_id');
    // }

    // public function patient()
    // {
    //     return $this->belongsTo(Patient::class, 'app_user_patient_id');
    // }
}

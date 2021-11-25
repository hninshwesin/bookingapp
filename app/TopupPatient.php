<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopupPatient extends Model
{
    protected $fillable = [
        'user_id', 'patient_id', 'amount', 'approve_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

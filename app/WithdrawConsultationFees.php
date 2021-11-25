<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawConsultationFees extends Model
{
    protected $fillable = [
        'doctor_id', 'amount', 'approve_status'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

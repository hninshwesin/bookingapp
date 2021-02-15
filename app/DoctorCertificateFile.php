<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorCertificateFile extends Model
{
    protected $guarded = [];

    public function doctors()
    {
        return $this->belongsToMany('App\Doctor');
    }
}

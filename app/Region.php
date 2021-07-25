<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = [];

    public function townships()
    {
        return $this->hasMany(Township::class);
    }

    public function ambulance()
    {
        return $this->hasMany(Ambulance::class);
    }

    public function clinic()
    {
        return $this->hasMany(Clinic::class);
    }

    public function lab()
    {
        return $this->hasMany(Lab::class);
    }

    public function pharmacy()
    {
        return $this->hasMany(Pharmacy::class);
    }

    // public function ambulances()
    // {
    //     return $this->belongsTo(Ambulance::class);
    // }
}

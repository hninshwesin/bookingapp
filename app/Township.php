<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $guarded = [];

    public function region()
    {
        return $this->belongsTo(Region::class);
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
}

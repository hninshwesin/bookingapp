<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    protected $guarded = [];

    public function app_users()
    {
        return $this->belongsToMany(AppUser::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function township()
    {
        return $this->belongsTo(Township::class);
    }
}

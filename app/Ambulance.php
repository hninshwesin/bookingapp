<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    protected $guarded = [];

    public function app_users() {
        return $this->belongsToMany(AppUser::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $guarded = [];

    public function app_users() {
        return $this->belongsToMany(AppUser::class);
    }
}

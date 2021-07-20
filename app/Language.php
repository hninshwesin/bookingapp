<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $guarded = [];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}

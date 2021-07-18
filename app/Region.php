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
}

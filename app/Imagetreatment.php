<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagetreatment extends Model
{
    protected $guarded = [];

    public function visits()
    {
        return $this->belongsTo('App\Visit');
    }
}

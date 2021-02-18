<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagefurtherplan extends Model
{
    protected $guarded = [];

    public function visits()
    {
        return $this->belongsTo('App\Visit');
    }
}

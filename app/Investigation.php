<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    public function visits()
    {
        return $this->belongsTo('App\Visit');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Physicalexamination extends Model
{
    public function visits()
    {
        return $this->belongsTo('App\Visit');
    }
}

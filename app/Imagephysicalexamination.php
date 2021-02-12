<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagephysicalexamination extends Model
{
    public function visits()
    {
        return $this->belongsTo('App\Visit');
    }
}

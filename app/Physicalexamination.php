<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Physicalexamination extends Model
{
    protected $guarded = [];

    public function visits()
    {
        return $this->belongsTo('App\Visit');
    }
}

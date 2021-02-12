<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagehistory extends Model
{
    public function visits()
    {
        return $this->belongsTo('App\Visit');
    }
}

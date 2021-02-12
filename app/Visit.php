<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function histories()
    {
        return $this->hasOne('App\History');
    }

    public function physicalexaminations()
    {
        return $this->hasOne('App\Physicalexamination');
    }

    public function investigations()
    {
        return $this->hasOne('App\Investigation');
    }

    public function treatments()
    {
        return $this->hasOne('App\Treatment');
    }

    public function furtherplans()
    {
        return $this->hasOne('App\Furtherplan');
    }

    public function others()
    {
        return $this->hasOne('App\Other');
    }

    public function imagehistories()
    {
        return $this->hasMany('App\Imagehistory');
    }
}

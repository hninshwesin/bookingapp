<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded = [];

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

    public function imagephysicalexaminations()
    {
        return $this->hasMany('App\Imagephysicalexamination');
    }

    public function imageinvestigation()
    {
        return $this->hasMany('App\Imageinvestigation');
    }

    public function imagetreatment()
    {
        return $this->hasMany('App\Imagetreatment');
    }

    public function imagefurtherplans()
    {
        return $this->hasMany('App\Imagefurtherplan');
    }

    public function imageothers()
    {
        return $this->hasMany('App\Imageother');
    }
}

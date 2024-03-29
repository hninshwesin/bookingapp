<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name', 'Age', 'Gender', 'Address', 'Contact_Number', 'app_user_id', 'profile_image', 'wallet'
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function waiting()
    {
        return $this->hasOne(WaitingList::class);
    }
}

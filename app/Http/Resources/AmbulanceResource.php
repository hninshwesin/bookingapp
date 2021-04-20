<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AmbulanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arrayData = [
            'id' => $this->id,
            'name' => $this->name,
            'charity_service' => $this->charity_service,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'available_time' => $this->available_time,
            'comment' => $this->comment,
            'favorite_status' => !!count($this->app_users),
        ];

        if($this->profile_image != 'null'){
            $arrayData['profile_image'] = Storage::url($this->profile_image);
        }elseif($this->profile_image == 'null') {
            $arrayData['profile_image'] = null;
        }

        return $arrayData;
    }
}

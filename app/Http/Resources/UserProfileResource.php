<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserProfileResource extends JsonResource
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
            'date_of_birth' => $this->date_of_birth,
            'sex' => $this->sex,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
        ];

        if($this->profile_image != 'null'){
            $arrayData['profile_image'] = Storage::url($this->profile_image);
        }elseif($this->profile_image == 'null') {
            $arrayData['profile_image'] = null;
        }

        return $arrayData;
    }
}

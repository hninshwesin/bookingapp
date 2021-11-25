<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PatientResource extends JsonResource
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
            'name' => $this->Name,
            'age' => $this->Age,
            'gender' => $this->Gender,
            'address' => $this->Address,
            'contact_number' => $this->Contact_Number,
            'date' => $this->created_at->format('Y-m-d H:i:s'),
            'app_user_id' => $this->app_user_id,
            'error_code' => '0',
            'status' => '2',
            'wallet' => $this->wallet,
        ];

        if ($this->profile_image) {
            $arrayData['profile_image'] = Storage::url($this->profile_image);
        } else {
            $arrayData['profile_image'] = null;
        }

        return $arrayData;
    }
}

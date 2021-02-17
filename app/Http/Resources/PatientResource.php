<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'Name' => $this->Name,
            'Age' => $this->Age,
            'Gender' => $this->Gender,
            'Address' => $this->Address,
            'Contact_Number' => $this->Contact_Number,
        ];
    }
}

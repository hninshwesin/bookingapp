<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LabResource extends JsonResource
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
            'name' => $this->name,
            'charity_service' => $this->charity_service,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'available_time' => $this->available_time,
            'comment' => $this->comment,
        ];
    }
}

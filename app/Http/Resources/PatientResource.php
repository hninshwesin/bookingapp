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
        $arrayData = [
            'id' => $this->id,
            'name' => $this->Name,
            'age' => $this->Age,
            'gender' => $this->Gender,
            'address' => $this->Address,
            'contact_number' => $this->Contact_Number,
            'app_user_id' => $this->app_user_id,
            'error_code' => '0',
            'status' => '2',
        ];

        return $arrayData;
    }
}

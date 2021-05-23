<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LastMessageResource extends JsonResource
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
            'app_user_doctor_id' => $this->app_user_doctor_id,
            'app_user_patient_id' => $this->app_user_patient_id,
            'last_message' => $this->last_message,
        ];
    }
}

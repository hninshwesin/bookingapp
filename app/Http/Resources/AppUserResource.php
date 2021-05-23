<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Patient;

class AppUserResource extends JsonResource
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
            'app_user_id' => $this->id,
            'name' => $this->name,
            'patient_info' => new PatientResource(Patient::where('app_user_id', $this->id)->first()),
            'status' => 0,
            'error_code' => 0
        ];
    }
}

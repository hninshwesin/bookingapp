<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\AppUser;
use App\Patient;

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
            // 'patient_info' => new AppUserResource(AppUser::find($this->app_user_patient_id)),
            'patient_info' => new PatientResource(Patient::where('app_user_id', $this->app_user_patient_id)->first()),
            'last_message' => $this->last_message
        ];
    }
}

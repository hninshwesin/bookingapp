<?php

namespace App\Http\Resources;

use App\Patient;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'appointment_datetime' => $this->appintment_datetime,
            'app_user_patient_id' => $this->app_user_patient_id,
            'app_user_doctor_id' => $this->app_user_doctor_id,
            'status' => $this->status,
            'patient_info' => new PatientResource(Patient::where('app_user_id', $this->patient_id)->first()),
        ];
    }
}

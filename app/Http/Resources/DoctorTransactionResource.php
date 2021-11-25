<?php

namespace App\Http\Resources;

use App\Patient;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorTransactionResource extends JsonResource
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
            'app_user_patient_id' => $this->app_user_patient_id,
            'app_user_doctor_id' => $this->app_user_doctor_id,
            'total_amount' => $this->total_amount,
            'to_doctor_amount' => $this->to_doctor_amount,
            'to_admin_amount' => $this->to_admin_amount,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'patient_info' => new PatientResource(Patient::where('app_user_id', $this->app_user_patient_id)->first()),

        ];
    }
}

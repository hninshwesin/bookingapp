<?php

namespace App\Http\Resources;

use App\AppUser;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Patient;
use Illuminate\Support\Str;

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
            'last_message' => strlen($this->last_message) > 50 ? Str::substr($this->last_message, 0, 50) . "..." : $this->last_message,
            'doctor_unread_status' => $this->doctor_unread_status,
            'patient_unread_status' => $this->patient_unread_status,
            'online_status' => new OnlineStatusResource(AppUser::find($this->app_user_patient_id)),
        ];
    }
}

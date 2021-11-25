<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorProfile extends JsonResource
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
            'sama_number' => $this->sama_number,
            'qualifications' => $this->Qualifications,
            'specialization' => $this->specialization,
            'contact_number' => $this->Contact_Number,
            'available_time' => $this->available_time,
            //            'start_time' => Carbon::parse($this->start_time)->format('g:i A'),
            'available_language' => new LanguageResourceCollection($this->languages),
            'email' => $this->Email,
            'other_option' => $this->other_option,
            'hide_my_info' => $this->hide_my_info,
            'app_user_id' => $this->app_user_id,
            'certificate_file' => new DoctorCertificateCollection($this->DoctorCertificateFile),
            'sama_or_nrc' => new DoctorSaMaOrNRCResourceCollection($this->DoctorSamaFileOrNrcFile),
            'error_code' => '0',
            'status' => '1',
            'active_status' => $this->active_status,
            'wallet' => $this->wallet,
        ];

        if ($this->DoctorProfilePicture) {
            $arrayData['profile_image'] = new DoctorProfilePictureResource($this->DoctorProfilePicture);
        } else {
            $arrayData['profile_image'] = null;
        }

        return $arrayData;
    }
}

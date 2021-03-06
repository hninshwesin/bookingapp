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
        return [
            'id' => $this->id,
            'Name' => $this->Name,
            'sama_number' => $this->sama_number,
            'Qualifications' => $this->Qualifications,
            'specialization' => $this->specialization,
            'Contact_Number' => $this->Contact_Number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_time' => Carbon::parse($this->start_time)->format('g:i A'),
            'end_time' => Carbon::parse($this->end_time)->format('g:i A'),
            'Email' => $this->Email,
            'other_option' => $this->other_option,
            'Certificate_File' => new DoctorCertificateCollection($this->DoctorCertificateFile),
            'Profile_image' => new DoctorProfilePictureResource($this->DoctorProfilePicture),
            'SaMa_or_NRC' => new DoctorSaMaOrNRCResourceCollection($this->DoctorSamaFileOrNrcFile),
        ];
    }
}

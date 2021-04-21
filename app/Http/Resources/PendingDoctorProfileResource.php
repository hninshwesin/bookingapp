<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PendingDoctorProfileResource extends JsonResource
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
            'Name' => $this->Name,
            'sama_number' => $this->sama_number,
            'Qualifications' => $this->Qualifications,
            'specialization' => $this->specialization,
            'Contact_Number' => $this->Contact_Number,
            'available_time' => $this->available_time,
            'Email' => $this->Email,
            'other_option' => $this->other_option,
            'hide_my_info' => $this->hide_my_info,
            'Certificate_File' => new DoctorCertificateCollection($this->DoctorCertificateFile),
            'SaMa_or_NRC' => new DoctorSaMaOrNRCResourceCollection($this->DoctorSamaFileOrNrcFile),
            'error_code' => '0',
            'status' => '3',
            'message' => 'pending',
        ];

        if($this->DoctorProfilePicture){
            $arrayData['Profile_image'] = new DoctorProfilePictureResource($this->DoctorProfilePicture);
        }else {
            $arrayData['Profile_image'] = null;
        }

        return $arrayData;
    }
}

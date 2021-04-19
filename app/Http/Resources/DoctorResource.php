<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
//            'name' => new DoctorCertificateCollection($this->DoctorCertificateFile()->name),
//            'certificate_file' => new DoctorCertificateCollection($this->DoctorCertificateFile()->certificate_file),
        ];
        
        if($this->DoctorProfilePicture){
            $arrayData['Profile_image'] = new DoctorProfilePictureResource($this->DoctorProfilePicture);
        }else {
            $arrayData['Profile_image'] = null;
        }

        return $arrayData;
    }
}

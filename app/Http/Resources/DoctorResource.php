<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'Name' => $this->Name,
            'Qualifications' => $this->Qualifications,
            'Contact_Number' => $this->Contact_Number,
            'Email' => $this->Email,
            'File' => new DoctorCertificateCollection($this->DoctorCertificateFile),
//            'name' => new DoctorCertificateCollection($this->DoctorCertificateFile()->name),
//            'certificate_file' => new DoctorCertificateCollection($this->DoctorCertificateFile()->certificate_file),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PendingDoctorProfileResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'doctor_profile' => $this->collection,
            'links' => [
                'error_code' => '0',
                'status' => '3',
                'message' => 'pending',
            ],
        ];
    }
}

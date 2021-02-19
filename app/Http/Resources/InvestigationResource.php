<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestigationResource extends JsonResource
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
            'blood_tests' => $this->Blood_tests,
            'urinalysis' => $this->Urinalysis,
            'swabs' => $this->Swabs,
            'ECG_Echo' => $this->ECG,
            'CXR' => $this->CXR,
            'USG' => $this->USG,
            'others' => $this->Others,
//            'files' => new ImageHistoryResourceCollection($this->imageinvestigation)
        ];
    }
}

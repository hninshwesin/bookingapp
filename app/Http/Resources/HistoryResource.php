<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
            'chief_complaint' => $this->Chief_complaint,
            'history_of_present_illness' => $this->History_of_present_illness,
            'past_medical_history' => $this->Past_medical_history,
            'past_surgical_history' => $this->Past_surgical_history,
            'social_history' => $this->Social_history,
            'drug_allergy' => $this->Drug_allergy,
            'others' => $this->Others,
//            'files' => new ImageHistoryResourceCollection($this->imagehistories)
        ];
    }
}

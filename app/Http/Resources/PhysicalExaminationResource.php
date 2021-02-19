<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhysicalExaminationResource extends JsonResource
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
            'general_Condition' => $this->General_Condition,
            'anaemia' => $this->Anaemia,
            'jaundice' => $this->Jaundice,
            'temperature' => $this->Temperature,
            'BP' => $this->BP,
            'PR' => $this->PR,
            'heart' => $this->Heart,
            'lungs' => $this->Lungs,
            'abdomen' => $this->Abdomen,
            'others' => $this->Others,
//            'files' => new ImageHistoryResourceCollection($this->imagephysicalexaminations)
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FurtherPlanResource extends JsonResource
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
            'further_plan' => $this->Further_plan,
//            'files' => new ImageHistoryResourceCollection($this->imagefurtherplans)
        ];
    }
}

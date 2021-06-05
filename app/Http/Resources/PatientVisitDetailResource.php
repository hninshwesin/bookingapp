<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientVisitDetailResource extends JsonResource
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
            'doctor_id' => $this->doctor_id,
            'doctor' => new DoctorProfile($this->doctor),
            'patient_id' => $this->patient_id,
            'visit_date' => $this->created_at->format('Y-m-d H:i:s'),
            'history' => new HistoryResource($this->histories),
            'history_files' => new ImageHistoryResourceCollection($this->imagehistories),
            'physical_examination' => new PhysicalExaminationResource($this->physicalexaminations),
            'physical_examination_files' => new ImagePhysicalExaminationResourceCollection($this->imagephysicalexaminations),
            'investigation' => new InvestigationResource($this->investigations),
            'investigation_files' => new ImageInvestigationResourceCollection($this->imageinvestigation),
            'treatment' => new TreatmentResource($this->treatments),
            'treatment_files' => new ImageTreatmentResourceCollection($this->imagetreatment),
            'further_plan' => new FurtherPlanResource($this->furtherplans),
            'further_plan_files' => new ImageFurtherPlanResourceCollection($this->imagefurtherplans),
            'other' => new OtherResource($this->others),
            'other_files' => new ImageOtherResourceCollection($this->imageothers),
        ];
    }
}

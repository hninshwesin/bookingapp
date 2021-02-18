<?php

namespace App\Http\Controllers\API;

use App\Furtherplan;
use App\History;
use App\Http\Controllers\Controller;
use App\Imagefurtherplan;
use App\Imagehistory;
use App\Imageinvestigation;
use App\Imageother;
use App\Imagephysicalexamination;
use App\Imagetreatment;
use App\Investigation;
use App\Other;
use App\Physicalexamination;
use App\Treatment;
use App\Visit;
use App\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $patient_id)
    {
//        dd($patient_id);
        $doctor = Auth::guard('doctor-api')->user();
//        dd($doctor->id);

        $waiting_list = WaitingList::where('doctor_id', [$doctor->id])->where('patient_id', $patient_id)->where('status', '0')->first();
        if ($waiting_list){
            //History
            $Chief_complaint = $request->input('chief_complaint');
            $History_of_present_illness = $request->input('history_of_present_illness');
            $Past_medical_history = $request->input('past_medical_history');
            $Past_surgical_history = $request->input('past_surgical_history');
            $Social_history = $request->input('social_history');
            $Drug_allergy = $request->input('drug_allergy');
            $Other_history = $request->input('other_history');

            //Physical Examination
            $General_Condition = $request->input('general_Condition');
            $Anaemia = $request->input('anaemia');
            $Jaundice = $request->input('jaundice');
            $Temperature = $request->input('temperature');
            $BP = $request->input('BP');
            $PR = $request->input('PR');
            $Heart = $request->input('heart');
            $Lungs = $request->input('lungs');
            $Abdomen = $request->input('abdomen');
            $Other_physical = $request->input('other_physical');

            //Investigation
            $Blood_tests = $request->input('blood_tests');
            $Urinalysis = $request->input('urinalysis');
            $Swabs = $request->input('swabs');
            $ECG = $request->input('ECG_Echo');
            $CXR = $request->input('CXR');
            $USG = $request->input('USG');
            $Other_investigation = $request->input('other_investigation');

            //Treatments
            $treatments = $request->input('treatment');

            //Further_plan
            $Further_plan = $request->input('further_plan');

            //Other
            $Other = $request->input('other');

            $visit = new Visit();
            $visit->doctor_id = $doctor->id;
            $visit->patient_id = $patient_id;
            $visit->save();

            $history = new History();
            $history->visit_id = $visit->id;
            $history->Chief_complaint = $Chief_complaint;
            $history->History_of_present_illness = $History_of_present_illness;
            $history->Past_medical_history = $Past_medical_history;
            $history->Past_surgical_history = $Past_surgical_history;
            $history->Social_history = $Social_history;
            $history->Drug_allergy = $Drug_allergy;
            $history->Others = $Other_history;
            $visit->histories()->save($history);
            if ($request->hasFile('history_images')){
                $history_files = $request->file('history_images');
                foreach ($history_files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $images = $file->store('public/visit_history');

                    Imagehistory::create([
                        'visit_id' => $visit->id,
                        'name' => $file_name,
                        'files' => $images
                    ]);
                }
            }

            $physical = new Physicalexamination();
            $physical->visit_id = $visit->id;
            $physical->General_Condition = $General_Condition;
            $physical->Anaemia = $Anaemia;
            $physical->Jaundice = $Jaundice;
            $physical->Temperature = $Temperature;
            $physical->BP = $BP;
            $physical->PR = $PR;
            $physical->Heart = $Heart;
            $physical->Lungs = $Lungs;
            $physical->Abdomen = $Abdomen;
            $physical->Others = $Other_physical;
            $visit->physicalexaminations()->save($physical);
            if ($request->hasFile('physical_images')){
                $physical_files = $request->file('physical_images');
                foreach ($physical_files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $images = $file->store('public/visit_physical');

                    Imagephysicalexamination::create([
                        'visit_id' => $visit->id,
                        'name' => $file_name,
                        'files' => $images
                    ]);
                }
            }

            $investigation = new Investigation();
            $investigation->visit_id = $visit->id;
            $investigation->Blood_tests = $Blood_tests;
            $investigation->Urinalysis = $Urinalysis;
            $investigation->Swabs = $Swabs;
        $investigation->ECG_Echo = $ECG;
            $investigation->CXR = $CXR;
            $investigation->USG = $USG;
            $investigation->Others = $Other_investigation;
            $visit->investigations()->save($investigation);
            if ($request->hasFile('investigation_images')){
                $investigation_files = $request->file('investigation_images');
                foreach ($investigation_files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $images = $file->store('public/visit_investigation');

                    Imageinvestigation::create([
                        'visit_id' => $visit->id,
                        'name' => $file_name,
                        'files' => $images
                    ]);
                }
            }

            $treatment = new Treatment();
            $treatment->visit_id = $visit->id;
            $treatment->treatment = $treatments;
            $visit->treatments()->save($treatment);
            if ($request->hasFile('treatment_images')){
                $treatment_files = $request->file('treatment_images');
                foreach ($treatment_files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $images = $file->store('public/visit_treatment');

                    Imagetreatment::create([
                        'visit_id' => $visit->id,
                        'name' => $file_name,
                        'files' => $images
                    ]);
                }
            }

            $further_plans = new Furtherplan();
            $further_plans->visit_id = $visit->id;
            $further_plans->Further_plan = $Further_plan;
            $visit->furtherplans()->save($further_plans);
            if ($request->hasFile('further_plan_images')){
                $further_plan_files = $request->file('further_plan_images');
                foreach ($further_plan_files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $images = $file->store('public/visit_furtherplan');

                    Imagefurtherplan::create([
                        'visit_id' => $visit->id,
                        'name' => $file_name,
                        'files' => $images
                    ]);
                }
            }

            $others = new Other();
            $others->visit_id = $visit->id;
            $others->other_notes_or_documents = $Other;
            $visit->others()->save($others);
            if ($request->hasFile('other_images')){
                $other_files = $request->file('other_images');
                foreach ($other_files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $images = $file->store('public/visit_other');

                    Imageother::create([
                        'visit_id' => $visit->id,
                        'name' => $file_name,
                        'files' => $images
                    ]);
                }
            }


            $waiting_list->status = 1;
            $waiting_list->save();


            return response(['message' => 'Successfully inserted']);
        }
        else{
            return response(['message' => 'Do not exit patient']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

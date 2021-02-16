<?php

namespace App\Http\Controllers\API;

use App\History;
use App\Http\Controllers\Controller;
use App\Visit;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
//        dd('hello');
        $doctor_id = $request->input('doctor_id');
        $visit_id = $request->input('visit_id');
        $patient_id = $request->input('patient_id');
        $Chief_complaint = $request->input('Chief_complaint');
        $History_of_present_illness = $request->input('History_of_present_illness');
        $Past_medical_history = $request->input('Past_medical_history');
        $Past_surgical_history = $request->input('Past_surgical_history');
        $Social_history = $request->input('Social_history');
        $Drug_allergy = $request->input('Drug_allergy');
        $Others = $request->input('Others');
        dd($doctor_id,$patient_id,$Chief_complaint,$History_of_present_illness);

        $visit = new Visit();
        $visit->doctor_id = $doctor_id;
        $visit->patient_id = $patient_id;
        $visit->save();

        $history = new History();
        $history->visit_id = $visit_id;
        $history->Chief_complaint = $Chief_complaint;
        $history->History_of_present_illness = $History_of_present_illness;
        $history->Past_medical_history = $Past_medical_history;
        $history->Past_surgical_history = $Past_surgical_history;
        $history->Social_history = $Social_history;
        $history->Drug_allergy = $Drug_allergy;
        $history->Others = $Others;
        $visit->histories()->save($history);

        return response(['message' => 'Successfully inserted']);
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

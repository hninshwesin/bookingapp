<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use App\WaitingList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $doctors = Doctor::with('patients')->where('approve_status', '1')->get();
        $doctors = Doctor::where('approve_status', '1')->get();
        $patients = Patient::all();
        
        return view('home')->with(['doctors' => $doctors, 'patients' => $patients]);
    }

//    public function getDataAjax(Request $request)
//
//    {
//        $search = $request->search;
//
//
//        if($search == ''){
//            $employees = Doctor::orderby('name','asc')->select('id','Name')->limit(5)->get();
//        }else{
//            $employees = Doctor::orderby('name','asc')->select('id','Name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
//        }
//
//        $response = array();
//        foreach($employees as $employee){
//            $response[] = array(
//                "id"=>$employee->id,
//                "text"=>$employee->Name
//            );
//        }
//
//        echo json_encode($response);
//        exit;
//
//    }

}

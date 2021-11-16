<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Auth;

class MedicalRecordController extends Controller
{
    /*public function index(){
        //$patients = Patient::where('clinic_id','=',Auth::user()->clinic_id)->paginate(5);
        $patients = Patient::where('clinic_id','=',Auth::user()->clinic_id)->get();
        $count = Patient::selectRaw('count(patients.id) as count')->where('clinic_id','=',Auth::user()->clinic_id)->get()[0]->count;
        return view('patients.index',compact('patients','count'));
    }*/
}

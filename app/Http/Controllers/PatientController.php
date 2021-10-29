<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Patient;
use Auth;

class PatientController extends Controller
{
    public function index(){
        $patients = Patient::where('clinic_id','=',Auth::user()->clinic_id)->paginate(20);
        return view('patients.index',compact('patients'));
    }

    public function store(Request $request){
        if(Auth::user()->hasPermissionTo('create patient')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:5|max:255',
                'dateBirth' => 'date|required',
                'phone' => 'required|digits:10|min:10|max:10',
                'address' => 'required|min:15|max:255',
                'employment' => 'nullable',
            ]);
            if ($validator->fails()) {
                return  Redirect::back()->withErrors($validator)->withInput();
            }
            //if($clinic = Clinic::create($request->all())){
            $patient = new Patient();
            $patient->name = $request->name;
            $patient->dateBirth = $request->dateBirth;
            $patient->phone = $request->phone;
            $patient->address = $request->address;
            $patient->employment = $request->employment;
            $patient->clinic_id = Auth::user()->clinic_id;
            if($patient->save()){
            return  Redirect::back()->with('success', 'Paciente creado satisfactoriamente.');
            }
          return  Redirect::back()->with('error', "No se puede crear el paciente.");

        }
        return Redirect::back()->with('error',Auth::user());
    }
}

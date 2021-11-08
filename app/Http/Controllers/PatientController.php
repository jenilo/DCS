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
            //$validator = $request->validate([
                'name' => 'required|string|min:5|max:255',
                'dateBirth' => 'date|required',
                'phone' => 'required|digits:10|min:10|max:10',
                'address' => 'required|string|min:15|max:255',
                'employment' => 'string|nullable',
            ]);
            if ($validator->fails())
                return  Redirect::back()->withErrors($validator)->withInput();
                //return  Redirect::back()->with('error', 'fallo el validator.');

            if($patient = Patient::create($request->all() + ['clinic_id' => Auth::user()->clinic_id]))
                return  Redirect::back()->with('success', 'Paciente creado satisfactoriamente.');

            return  Redirect::back()->with('error', "No se puede crear el paciente.");

        }
        return Redirect::back()->with('error',Auth::user());
    }

    public function search($name = null){
        $patients = Patient::where('clinic_id','=',Auth::user()->clinic_id)->where('name','like',$name.'%')->get();
        return response()->json($patients);
    }
}

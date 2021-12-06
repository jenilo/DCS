<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Form;
use Carbon\Carbon;
use App\Models\Clinic;
use Auth;

class PatientController extends Controller
{
    public function index(){
        //$patients = Patient::where('clinic_id','=',Auth::user()->clinic_id)->paginate(5);
        $patients = Patient::where('clinic_id','=',Auth::user()->clinic_id)->get();
        $count = Patient::selectRaw('count(patients.id) as count')->where('clinic_id','=',Auth::user()->clinic_id)->get()[0]->count;
        $clinic = Clinic::find(Auth::user()->clinic_id);
        return view('patients.index',compact('patients','count','clinic'));
    }

    public function store(Request $request){
        if(Auth::user()->hasPermissionTo('create patient')){
            //Validar los datos del request
            $date = Carbon::now();
            $date = $date->toDateString();

            $validator = Validator::make($request->all(), [
            //$validator = $request->validate([
                'name' => 'required|string|min:5|max:255',
                'dateBirth' => 'date|required',
                'phone' => 'required|digits:10|min:10|max:10',
                'address' => 'required|string|min:15|max:255',
                'employment' => 'string|nullable',
                'observations' => 'string|nullable'
            ]);
            //return $request;
            if ($validator->fails())
                return  Redirect::back()->withErrors($validator)->withInput();

            if($patient = Patient::create($request->all() + ['clinic_id' => Auth::user()->clinic_id])){
                $request->observations = ($request->observations != null)? $request->observations : "Sin observaciones.";
                $medical_record = MedicalRecord::create(['dateAdmission'=>$date, 'observations'=> $request->observations, 'patient_id' => $patient->id]);
                //return  Redirect::back()->with('success', 'Paciente creado satisfactoriamente.');
                return redirect()->route('patients')->with(['code'=> '200', 'short' => 'Exitoso!','message'=>'Paciente creado satisfactoriamente.']);
            }
            return  Redirect::back()->with(['code'=> '200', 'short' => 'Exitoso!','message'=> "No se puede crear el paciente."]);

        }
        return Redirect::back()->with(['code'=> '200', 'short' => 'Exitoso!','message'=> "No tiene permiso para esto."]);
    }

    public function search($name = null){
        $patients = Patient::where('clinic_id','=',Auth::user()->clinic_id)->where('name','like',$name.'%')->get();
        return response()->json($patients);
    }

    public function show($id){
        $patient = Patient::where('patients.id','=',$id)->with('medical_records','medical_records.files','medical_records.forms_completed','medical_records.forms_completed.form','appointments')->where('clinic_id','=',Auth::user()->clinic_id)->get();
        $forms = Form::where('clinic_id','=',Auth::user()->clinic_id)->get();
        if ($patient->count() > 0){
            $patient = $patient[0];
        }
        else
            return abort(404, 'Page not found.');
        return view('patients.details',compact('patient','forms'));
    }
    
    public function destroy($patient){

        if (Auth::user()->hasPermissionTo('delete patient')) {
            //$patient = Patient::where('id','=',$patient)->first();
            $patient = Patient::find($patient);
            if ($patient != null) {
                $count = Patient::selectRaw("count('patient_id') as count")->join('appointments','appointments.patient_id','=','patients.id')->where('patients.id','=',$patient->id)->groupBy('patient_id')->first();
                //return ($count==null)? "Vacio" : "nO VACIO";
                if ($count == null) {
                    if($patient->delete()) {
                        return response()->json(['code'=> '200','short' => 'Eliminado!','message'=>'Se ha eliminado con exito.']);
                    }
                    return response()->json(['code'=> '400','short' => 'Error!','message'=>'No se elimino el paciente.']);
                }
                else{
                    return response()->json(['code'=> '400','short' => 'Error!','message'=>'Este paciente tiene '.$count->count.' citas, no puede eliminarse.']);
                }
            }
            else{
                return response()->json(['code'=> '404','short' => 'Error!','message'=>'Registro no encontrado.']);
            }
        }
        return response()->json(['code'=> '400','short' => 'Error!','message'=>'No tienes permiso para esto.']);
    }
}

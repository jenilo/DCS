<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Treatment;
use Auth;

class AppointmentController extends Controller
{
    public function index(){
        return view('appointments.index');
    }

    public function show($id){
        $appointments = Appointment::select('appointments.*','patients.name','patients.dateBirth','patients.phone','treatments.name as treatment_name','patients.employment')->join('patients','appointments.patient_id','=','patients.id')->where('patients.clinic_id','=',Auth::user()->clinic_id)->where('appointments.id','=',$id)->join('treatments','appointments.treatment_id','=','treatments.id')->get();
        return response()->json($appointments[0]);
    }

    public function all(){
        $appointments = Appointment::select('appointments.*','patients.name')->join('patients','appointments.patient_id','=','patients.id')->where('clinic_id','=',Auth::user()->clinic_id)->get();

        $results = [];
        foreach($appointments as $appointment){ 
            $save = [
                'id' => $appointment->id,
                'title' => $appointment->name,
                'start' => $appointment->date." ".$appointment->timeStart,
                'end' => $appointment->date." ".$appointment->timeEnd,
            ];
            $results[] = $save;
        }
        return response()->json($results);
    }

    public function create($date = null){
        $treatments = Treatment::where('clinic_id','=',Auth::user()->clinic_id)->get();
        return view('appointments.create',compact('date','treatments'));
    }

    public function store(Request $request){
        if(Auth::user()->hasPermissionTo('create appointment')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
                'date' => 'required|date',
                'timeStart' => 'required',
                'notes' => 'nullable|string',
                'patient_id' => 'required',
                'treatment_id' => 'required'

            ]);
            if ($validator->fails()) 
                return  Redirect::back()->withErrors($validator)->withInput();

            //pregunta si existe una cita para esa fecha.

            //if () {
                if($appointment = Appointment::create($request->all()))
                    //return  redirect()->back()->with('success', 'Cita creada satisfactoriamente.');
                    return redirect()->route('appointments')->with(['code'=> '200', 'short' => 'Exitoso!','message'=>'Cita creada']);
                else
                    return  redirect()->back()->with(['code'=> '400', 'short' => 'Error!','message'=>'No se puede crear la cita']);
            //}

        }
        return redirect()->back()->with(['code'=> '400', 'short' => 'Error!','message'=>'No tienes permiso']);
    }

}

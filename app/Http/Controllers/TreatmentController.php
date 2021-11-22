<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Treatment;
use Auth;

class TreatmentController extends Controller
{
    //
    public function index(){
        $treatments = Treatment::where('clinic_id','=',Auth::user()->clinic_id)->paginate(20);
        return view('treatments.index',compact('treatments'));
    }

    public function store(Request $request){
        if(Auth::user()->hasPermissionTo('create treatment')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
            //$validator = $request->validate([
                'name' => 'required|string|min:5|max:255',
            ]);
            if ($validator->fails())
                return  Redirect::back()->withErrors($validator)->withInput();
                //return  Redirect::back()->with('error', 'fallo el validator.');

            if($treatment = Treatment::create($request->all() + ['clinic_id' => Auth::user()->clinic_id]))
                return  Redirect::back()->with('success', 'Paciente creado satisfactoriamente.');

            return  Redirect::back()->with('error', "No se puede crear el paciente.");

        }
        return Redirect::back()->with('error',Auth::user());
    }

    public function update(Request $request){
        

    }

    public function appointments($treatment){
        $treatmentExist = Treatment::where('id','=',$treatment)->first();
        if ($treatmentExist!=null) {
            $count = Treatment::selectRaw("count('treatment_id') as count")->join('appointments','appointments.treatment_id','=','treatments.id')->where('treatments.id','=',$treatment)->groupBy('treatment_id')->first();

            return response()->json(['code'=> '400','message'=>$count]);
        }
        return response()->json(['code'=> '404']);
    }

    public function destroy($treatment){

        if (Auth::user()->hasPermissionTo('delete treatment')) {
            $treatment = Treatment::where('id','=',$treatment)->first();
            if ($treatment != null) {
                $count = Treatment::selectRaw("count('treatment_id') as count")->join('appointments','appointments.treatment_id','=','treatments.id')->where('treatments.id','=',$treatment->id)->groupBy('treatment_id')->first();
                if ($count == null) {
                    if ($treatment->delete()) {
                        return response()->json(['code'=> '200','message'=>'Eliminado exitoso']);
                    }
                    return response()->json(['code'=> '400','message'=>'No se elimino el tratamiento.']);
                }
                else{
                    return response()->json(['code'=> '400','message'=>'Este tratamiento tiene '.$count->count.' citas, no puede eliminarse.']);
                }
            }
            else{
                return response()->json(['code'=> '404','message'=>'Registro no encontrado.']);
            }
        }
        return response()->json(['code'=> '400','message'=>'No tienes permiso para esto.']);
    }
}

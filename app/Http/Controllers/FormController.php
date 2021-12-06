<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Form;
use App\Models\Clinic;
use Auth;

class FormController extends Controller
{
    public function index(){
        $forms = Form::where('clinic_id','=',Auth::user()->clinic_id)->paginate(20);
        $clinic = Clinic::find(Auth::user()->clinic_id);
        return view('forms.index',compact('forms','clinic'));
    }

    public function store(Request $request){
        if(Auth::user()->hasPermissionTo('create form')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
            //$validator = $request->validate([
                'name' => 'required|string|min:5|max:255',
            ]);
            if ($validator->fails())
                return  Redirect::back()->withErrors($validator)->withInput();
                //return  Redirect::back()->with('error', 'fallo el validator.');

            if($form = Form::create($request->all() + ['clinic_id' => Auth::user()->clinic_id]))
                return  redirect()->route('createquestions',['form' => $form->id]);

            return  Redirect::back()->with('error', "No se puede crear el formulario.");

        }
        return Redirect::back()->with('error',"No tiene permisos");
    }

    public function destroy($form){

        if (Auth::user()->hasPermissionTo('delete form')) {
            $form = Form::find($form);
            //return $form;

            if ($form != null) {
                $count = Form::selectRaw("count('form_id') as count")->join('completed_forms','completed_forms.form_id','=','forms.id')->where('forms.id','=',$form->id)->groupBy('form_id')->first();
                if ($count == null) {
                    if ($form->delete())
                        return response()->json(['code'=> '200','message'=>'Eliminado exitoso']);
                    return response()->json(['code'=> '400','message'=>'No se elimino el formulario.']);
                }
                else{
                    return response()->json(['code'=> '400','message'=>'Este cuestionario tiene '.$count->count.' resueltos, no puede eliminarse.']);
                }
            }
            else{
                return response()->json(['code'=> '404','message'=>'Registro no encontrado.']);
            }
        }
        return response()->json(['code'=> '400','message'=>'No tienes permiso para esto.']);
    }
}

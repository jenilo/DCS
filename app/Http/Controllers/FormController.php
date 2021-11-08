<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Form;
use Auth;

class FormController extends Controller
{
    public function index(){
        $forms = Form::where('clinic_id','=',Auth::user()->clinic_id)->paginate(20);
        return view('forms.index',compact('forms'));
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

            return  Redirect::back()->with('error', "No se puede crear el paciente.");

        }
        return Redirect::back()->with('error',"No tiene permisos");
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Answer;
use App\Models\Patient;
use App\Models\Question;
use App\Models\CompletedForm;
use App\Models\MedicalRecord;

use Carbon\Carbon;
use Auth;

class CompletedFormController extends Controller
{
    /*public function index(Request $request){
        $medical_record = MedicalRecord::where('id','=',$request->medical_record_id)->with('patient')->get()[0];
        $form = Form::where('id','=',$request->form_id)->with('questions')->get()[0];

        return view('forms.complete',compact('form','medical_record'));
    }*/
    public function index($medical_record_id, $form_id){
        $medical_record = MedicalRecord::where('id','=',$medical_record_id)->with('patient')->get()[0];
        $form = Form::where('id','=',$form_id)->with('questions')->get()[0];

        return view('forms.complete',compact('form','medical_record'));
    }

    public function store(Request $request){
        //cambiar a create completeform
        if(Auth::user()->hasPermissionTo('create form')){
            //return $request;
            $date = Carbon::now();
            $date = $date->toDateString();
            $completedForm = new CompletedForm();
            $completedForm->saveDate = $date;
            $completedForm->medical_record_id = $request->medical_record_id;
            $completedForm->form_id = $request->form_id;
            if($completedForm->save()){
                foreach($request->response as $key => $value){
                    $answer = new Answer();
                    $answer->answer = ($value != null || $value != "")? $value : -1;
                    $answer->question_id = $key;
                    $answer->completed_form_id = $completedForm->id;
                    $answer->save();
                }
                return redirect()->route('patient',$request->patient_id)->with(['code'=> '200', 'short' => 'Exitoso!','message'=>'Formulario completo']);
            }
            else
                return redirect()->back()->with(['code'=> '400','message'=>'No se puede completar el formulario']);
        }
        return redirect()->route('patient',$request->patient_id)->with(['code'=> '400','message'=>'No tienes permiso']);
    }

    public function show($completed_form){

        $completed_form = completedForm::with('answers','form','answers.question','medical_record','medical_record.patient',)->where('id','=',$completed_form)->first();

        if ($completed_form)
            return view('forms.completed',compact('completed_form'));

        return abort(404, 'Page not found.');
    }

    public function update(Request $request){
        $date = Carbon::now();
        $date = $date->toDateString();

        $completedForm = CompletedForm::where('id','=',$request->medical_record_id)->first();

        //$completedForm->saveDate = $date;
        //$completedForm->save();

        if($completedForm->update(['saveDate' => $date])){
            foreach($request->response as $key => $value){
                $answer = Answer::where('id','=',$key)->first();
                $answer->update(['answer' => $value]);
                //$answer->save();
            }
            //return redirect()->back()->with('succes', "Formulario completo.");
            return response()->json(['code'=> '200','message'=>'Formulario actualizado']);
        }
        return response()->json(['code'=> '400','message'=>'Formulario no actualizado']);

    }
}

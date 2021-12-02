<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\AnswerType;
use App\Models\Question;
use App\Models\Form;
use Auth;

class QuestionController extends Controller
{
    public function index(Form $form){
        $answertypes = AnswerType::all();
        return view('forms.create',compact('form','answertypes'));
    }
    public function store(Request $request){

        if(Auth::user()->hasPermissionTo('create form')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
            //$validator = $request->validate([
                'inputs.*.question' => 'required|string|min:5|max:255',
                'inputs.*.answer_type_id' => 'required',
            ]);

            if ($validator->fails())
                //return  Redirect::back()->withErrors($validator)->withInput();
                return response()->json($validator->errors());

            /*if($form = Form::create($request->all() + ['clinic_id' => Auth::user()->clinic_id]))
                return  redirect()->route('createquestions',['form' => $form->id]);*/
            foreach ($request->inputs as $value){
                Question::create($value + ['form_id' => $request->inputs[0]['form_id']]);
            }

            //return  Redirect::back()->with('error', "No se puede crear las preguntas.");
            return response()->json(['code'=> '200','message'=>'Creación exitosa.']);

        }
        //return Redirect::back()->with('error',"No tiene permisos.");
        return response()->json(['code'=> '400','message'=>"No tiene permisos"]);
    }

    public function edit(Form $form){
        $questions = Form::with('questions')->where('id','=',$form->id)->get();
        $answertypes = AnswerType::all();
        return view('forms.edit', compact('form','questions','answertypes'));
    }

    public function update(Request $request){
        if(Auth::user()->hasPermissionTo('update form')){
            //Validar los datos del request
            //return response()->json($request);
            $validator = Validator::make($request->all(), [
            //$validator = $request->validate([
                'inputs.*.question' => 'required|string|min:5|max:255',
                'inputs.*.answer_type_id' => 'required',
            ]);

            if ($validator->fails())
                //return  Redirect::back()->withErrors($validator)->withInput();
                return response()->json($validator->errors());

            $values[] = "0";
            
            foreach ($request->inputs as $value){
                if ($value['id'] != '-1') {
                    $question = Question::find($value['id'])->update(['question' => $value['question'],
                            'answer_type_id' => $value['answer_type_id']]);
                }
                else{
                    Question::create(['question' => $value['question'],
                        'answer_type_id' => $value['answer_type_id'],
                        'form_id' => $request->form_id
                    ]);
                }
            }
            return response()->json(['code'=> '200','message'=>'Edición exitosa']);

            //return  Redirect::back()->with('error', "No se puede crear las preguntas.");
            return response()->json(['code'=> '400','message'=>'No se puede crear las preguntas']);

        }
        //return Redirect::back()->with('error',"No tiene permisos.");
        return response()->json(['code'=> '400','message'=>'No tienes permisos']);
    }

    public function destroy(Question $question){
        if (Auth::user()->hasPermissionTo('delete form')) {
            if ($question) {
                if ($question->delete()) {
                    return response()->json(['code'=> '200','message'=>'Eliminado exitoso']);
                }
                return response()->json(['code'=> '400','message'=>'No se elimino la pregunta.']);
            }
        }
        return response()->json(['code'=> '400','message'=>'No tienes permiso para esto.']);
    }
}

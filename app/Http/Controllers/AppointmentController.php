<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        return view('appointments.index');
    }

    public function filter(Request $request){
        
    }

    /*public function store(Request $request){
        if(Auth::user()->hasPermissionTo('create appointment')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:clinics|min:5|max:255',
            ]);
            if ($validator->fails()) {
                return  redirect()->back()->withErrors($validator)->withInput();
            }
            if($clinic = Clinic::create($request->all())){
                $clinic = new Clinic();
                $clinic->name = $request->name;
                $clinic->token = Hash::make(Str::random(48));
                //$clinic->path = Str::slug($clinic->name);
                $clinic->path = Str::slug(Str::replace(' ', '', $clinic->name));
                if($clinic->save()){
                //$receivers = Receiver::pluck('email');
                Mail::to('jennylopezu@gmail.com')->send(new SendTokenToUser());
                //crear usuario tipo admin asignando token


                return  redirect()->back()->with('success', 'Clinica creada satisfactoriamente.');
            }
          return  redirect()->back()->with('error', "No se puede crear la clinica.");

        }
        return redirect()->back->with('error','No tienes permiso.');
    }

    public function show(Clinic $clinic){

        //return redirect()->back()->with('error','tipo de error');
    }

    public function update(Request $request, Clinic $clinic){
        //return redirect()->back()->with('error','tipo de error');
    }

    public function destroy(Clinic $clinic){

        if(Auth::user()->hasPermissionTo('delete clinic')){
            if($clinic){
                //Se elimina la clinica 
                if($clinic->delete()){
                    return response()->json([
                        'message' => 'Clinica eliminada.', 
                        'code' => '200'
                    ]);
                }
                return response()->json([
                        'message' => "No se puede eliminar la clinica", 
                        'code' => '400'
                    ]);
            }
        }

        return response()->json([
            'message' => 'No tienes permiso para eliminar.', 
            'code' => '200'
        ]);
    }*/
}

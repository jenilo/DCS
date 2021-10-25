<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Clinic;

class ClinicController extends Controller
{
    public function index(){
        //return view();
    }

    public function store(ClinicRequest $request){
        if(Auth::user()->hasPermissionTo('crud clinics')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:clinics|min:5|max:255',
            ]);
            if ($validator->fails()) {
                return  redirect()->back()->->withErrors($validator)->withInput();
            }
            if($clinic = Clinic::create($request->all())){
                $clinic->token = Hash::make(Str::random(48));
                //$clinic->path = Str::slug($clinic->name);
                $clinic->path = Str::slug(Str::replace(' ', '', $clinic->name));
                $clinic->save();

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

    public function update(ClinicRequest $request, Clinic $clinic){
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
    }
}

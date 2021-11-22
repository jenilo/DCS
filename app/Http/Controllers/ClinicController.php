<?php

namespace App\Http\Controllers;

//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Clinic;
use App\Models\User;
use App\Mail\SendTokenToUser;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Enums\UserType;
use Auth;

class ClinicController extends Controller
{
    public function index(){
        //return view();
    }

    public function store(Request $request){
        //if(Auth::user()->hasPermissionTo('crud clinics')){
            //Validar los datos del request
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:clinics|min:5|max:255',
                'password' => 'required|min:6|max:255',
                'email' => 'required|unique:users|email',
                'nameUser' => 'required|min:10|max:255'
            ]);
            if ($validator->fails()) {
                return  redirect()->back()->withErrors($validator)->withInput();
            }
            $clinic = new Clinic();
            $clinic->name = $request->name;
            $clinic->token = Hash::make(Str::random(48));
            $clinic->path = Str::slug(Str::replace(' ', '', $clinic->name));
            if($clinic->save()){
                //crear usuario tipo admin asignando token
                $user = new User();
                $user->name = $request->nameUser;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role_id = UserType::Admin;
                $user->clinic_id = $clinic->id;
                $user->token = $clinic->token;
                if ($user->save()) {
                    return  redirect()->back()->with('success', 'Clinica creada satisfactoriamente.');
                }
                $clinic->delete();
                return  redirect()->back()->with('error', 'No se puede crear la clinica.');
            }
          return  redirect()->back()->with('error', "No se puede crear la clinica.");

        /*}
        return redirect()->back->with('error','No tienes permiso.');*/
    }

    public function show(){
        $clinic = Clinic::where('id','=',Auth::user()->clinic_id)->first();
        return view('dashboard',compact('clinic'));
        
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
    }
}

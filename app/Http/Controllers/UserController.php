<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Enums\UserType;
use App\Models\User;

use Auth;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::where('clinic_id','=',Auth::user()->clinic_id)->with('role')->get();
        return view('users.index',compact('users'));
    }

    public function store(Request $request){
        if(Auth::user()->hasPermissionTo('create user')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:5|max:255',
                'email' => 'required|email',
                'password' => 'required|min:6|max:255',
            ]);
            if ($validator->fails())
                return  Redirect::back()->withErrors($validator)->withInput();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = UserType::User;
            $user->token = Auth::user()->token;
            $user->clinic_id = Auth::user()->clinic_id;
            if($user->save()){
                $user->givePermissionTo([
                    'crud users for clinic',
                    'read clinic',
                    'update clinic',
                    'delete clinic',
                    'create appointment',
                    'read appointment',
                    'update appointment',
                    'delete appointment',
                    'create patient',
                    'read patient',
                    'update patient',
                    'delete patient',
                    'create treatment',
                    'read treatment',
                    'update treatment',
                    'delete treatment',
                    'create form',
                    'read form',
                    'update form',
                    'delete form',
                    'create user',
                    'read user',
                    'update user',
                    'delete user',
                ]);
                return  Redirect::back()->with('success', 'Usuario creado satisfactoriamente.');
            }

            return  Redirect::back()->with('error', "No se puede crear el usuario.");

        }
        return Redirect::back()->with('error',"No tiene permiso para esto.");
    }

    public function destroy($user){

        if (Auth::user()->hasPermissionTo('delete user')) {
            $user = User::where('id','=',$user)->first();
            if ($user != null) {
                if ($user->delete()) {
                    return response()->json(['code'=> '200','message'=>'Eliminado exitoso']);
                }
                return response()->json(['code'=> '400','message'=>'No se elimino el usuario.']);
            }
            else{
                return response()->json(['code'=> '404','message'=>'Registro no encontrado.']);
            }
        }
        return response()->json(['code'=> '400','message'=>'No tienes permiso para esto.']);
    }

}

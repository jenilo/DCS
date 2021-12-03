<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\File;
use Carbon\Carbon;
use Auth;

class FileController extends Controller
{
    public function store(Request $request){
        $clinic = Clinic::where('id','=',Auth::user()->clinic_id)->first();

        $date = Carbon::now();
        $date = $date->toDateString();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:255',
            'file' => 'required|mimes:jpg,png,pdf',
            'medical_record_id' => 'required',
        ]);

        if ($validator->fails())
                return  Redirect::back()->withErrors($validator)->withInput();

        $path = $request->file('file')->store('public/'.$clinic->path);

        $file = new File();
        $file->name = $request->name;
        $file->filePath = $path;
        $file->medical_record_id = $request->medical_record_id;
        $file->saveDate = $date;
        if($file->save()){
            return Redirect::back()->with(['code'=> '200','message'=>'archivo subido con exito']);
        }

        Storage::delete($path);
        return Redirect::back()->with(['code'=> '400','message'=>'error al subir el archivo']);
    }

    function odontogram($patient){
        $patient = Patient::where('id','=',$patient)->first();
        $medical_record = MedicalRecord::where('patient_id','=',$patient->id)->first();
        return view('forms.odontogram',compact('patient','medical_record'));
    }

    function storeOdontogram(Request $request){
        $date = Carbon::now();
        $date = $date->toDateString();
        $clinic = Clinic::where('id','=',Auth::user()->clinic_id)->first();

        $img = $request->imgBase64;
        $imageName = Str::random(10).'.'.'png';
        $img = Str::replace('data:image/png;base64,', '', $img);
        $img = Str::replace(' ', '+', $img);
        $data = base64_decode($img);
        $path = Storage::put('public/'.$clinic->path.'/'.$imageName, $data);
        if ($path == 1)
            $path = 'public/'.$clinic->path.'/'.$imageName;
        else
            return response()->json(['code'=> '400','short'=>'Error','message'=>'Error al subir el archivo']);
            
        $file = new File();
        $file->name = $request->name;
        $file->filePath = $path;
        $file->medical_record_id = $request->medical_record_id;
        $file->saveDate = $date;
        if($file->save()){
            return response()->json(['code'=> '200','short'=>'Exito','message'=>'Archivo subido con exito','url' => route('patient',['patient' => $request->patient_id])]);
        }

        //Storage::delete($path);
        return response()->json(['code'=> '400','short'=>'Error','message'=>'error al subir el archivo']);
    }
}

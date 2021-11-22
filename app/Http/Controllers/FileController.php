<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Clinic;
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
        return Redirect::back()->with(['code'=> '200','message'=>'error al subir el archivo']);
    }
}

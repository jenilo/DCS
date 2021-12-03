<?php

use Illuminate\Support\Facades\Route;
use App\Enums\UserType;

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\CompletedFormController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
/*
Route::get('sendmail', function() {
    //
});
Route::prefix('superadmin')->middleware('ensureUserHasRole:'.UserType::SuperAdmin)->group(function () {
    Route::get('/h',function (){
        return 'Hello superadmin';
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('isNotLogin');

/*Route::group(['prefix' => 'clinic'], function() {
    Route::post('register', [ClinicController::class, 'store']);
    Route::get('register', function() {return view('clinics.register');})->name('clinicregister');
    Route::get('register', function() {return view('clinics.register');})->name('clinicregister');
});*/

Route::post('register', [ClinicController::class, 'store']);
/*Route::get('register', function() {return view('clinics.register');})->name('register');
Route::get('login', function() {return view('clinics.login');})->name('login');*/

Route::group(['middleware' => 'auth'], function () {

    //Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('/clinic',[ClinicController::class,'show'])->name('clinic');
    Route::get('/dashboard',[ClinicController::class,'index'])->name('home');


    Route::get('patients', [PatientController::class, 'index'])->name('patients'); //probablemente ocupe middleware despues
    Route::get('patients/search/{name?}', [PatientController::class, 'search'])->name('searchpatient');
    Route::group(['middleware' => 'can:create patient'], function(){
        Route::get('patients/create', function (){ return view('patients.create'); })->name('createpatient');
        Route::post('patients', [PatientController::class, 'store']);
        Route::get('patient/{patient}', [PatientController::class, 'show'])->name('patient');
        Route::get('patient/{medical_record}/form/{form}/create', [CompletedFormController::class, 'index'])->name('completeform');
        //Route::get('patient/{medical_record}/form/{form}/show', [CompletedFormController::class, 'show'])->name('showcompleteform');
        Route::get('patient/completedform/{completed_form}', [CompletedFormController::class, 'show'])->name('showcompletedform');
        Route::post('patient/completeform/create', [CompletedFormController::class, 'store'])->name('createcompleteform');
        Route::post('patient/completeform/update', [CompletedFormController::class, 'update'])->name('updatecompleteform');
        Route::delete('patients/{patient}', [PatientController::class, 'destroy'])->name('patientdestroy');

        //Route::get('patient/{patient}/odontogram', function() {return view('forms.odontogram');})->name('odontogram');
        Route::get('patient/{patient}/odontogram', [FileController::class, 'odontogram'])->name('odontogram');

        Route::post('patient/file/create',[FileController::class, 'store'])->name('createfile');
        Route::post('patient/odontogram/create',[FileController::class, 'storeOdontogram'])->name('createodontogram');
    });

    
    Route::group(['middleware' => 'can:create user'], function(){
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('users/create', function (){ return view('users.create'); })->name('createuser');
        //Route::get('users/appointments/{treatment}', [TreatmentController::class, 'appointments'])->name('treatmentappointments');
        Route::post('users', [UserController::class, 'store']);
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('userdestroy');
    });

    Route::get('treatments', [TreatmentController::class, 'index'])->name('treatments');
    Route::group(['middleware' => 'can:create treatment'], function(){
        Route::get('treatments/create', function (){ return view('treatments.create'); })->name('createtreatment');
        //Route::get('treatments/appointments/{treatment}', [TreatmentController::class, 'appointments'])->name('treatmentappointments');
        Route::post('treatments', [TreatmentController::class, 'store']);
        Route::delete('treatments/{treatment}', [TreatmentController::class, 'destroy'])->name('treatmentdestroy');
    });

    Route::get('forms', [FormController::class, 'index'])->name('forms');
    Route::group(['middleware' => 'can:create form'], function(){
        Route::get('forms/create', function (){ return view('forms.create'); })->name('createform');
        Route::post('forms', [FormController::class, 'store']);
        Route::get('form/{form}/questions/create', [QuestionController::class, 'index'])->name('createquestions');
        Route::post('questions', [QuestionController::class, 'store']);
        Route::get('form/{form}/questions/edit', [QuestionController::class, 'edit'])->name('editquestions');
        Route::post('questions/edit', [QuestionController::class, 'update']);
        Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('questiondestroy');
        Route::delete('forms/{form}', [FormController::class, 'destroy'])->name('formdestroy');
    });
    
    
    Route::get('appointments/create/{date?}', [AppointmentController::class, 'create'])->name('createappointment');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('saveappointment');
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('appointments/show/{id}', [AppointmentController::class, 'show']);
    Route::get('appointments/all/', [AppointmentController::class, 'all']);

});

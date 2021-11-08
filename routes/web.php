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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'clinic'], function() {
    Route::post('register', [ClinicController::class, 'store']);
    Route::get('register', function() {return view('clinics.register');})->name('clinicregister');
});

Route::get('sendmail', function() {
    //
});

/*Route::prefix('superadmin')->middleware('ensureUserHasRole:'.UserType::SuperAdmin)->group(function () {
    Route::get('/h',function (){
        return 'Hello superadmin';
    });
});*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::get('users', [UserController::class, 'index'])->name('users');


    Route::get('patients', [PatientController::class, 'index'])->name('patients'); //probablemente ocupe middleware despues
    Route::get('patients/search/{name?}', [PatientController::class, 'search'])->name('searchpatient');
    Route::group(['middleware' => 'can:create patient'], function(){
        Route::get('patients/create', function (){ return view('patients.create'); })->name('createpatient');
        Route::post('patients', [PatientController::class, 'store']);
    });

    Route::get('treatments', [TreatmentController::class, 'index'])->name('treatments');
    Route::group(['middleware' => 'can:create treatment'], function(){
        Route::get('treatments/create', function (){ return view('treatments.create'); })->name('createtreatment');
        Route::post('treatments', [TreatmentController::class, 'store']);
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
        //Route::post('questions', [QuestionController::class, 'destroy'])->name('questiondestroy');

    });
    
    
    Route::get('appointments/create/{date?}', [AppointmentController::class, 'create'])->name('createappointment');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('saveappointment');
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('appointments/show/{id}', [AppointmentController::class, 'show']);
    Route::get('appointments/all/', [AppointmentController::class, 'all']);

});

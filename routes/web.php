<?php

use Illuminate\Support\Facades\Route;
use App\Enums\UserType;

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;

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

Route::get('clinicregister', function() {
    return view('clinics.register');
});

Route::get('sendmail', function() {
    //
});

Route::post('clinicregister', [ClinicController::class, 'store'])->name('clinicregister');

/*Route::prefix('superadmin')->middleware('ensureUserHasRole:'.UserType::SuperAdmin)->group(function () {
     //return 'Hello World super admin';
    Route::get('/h',function (){
        return 'Hello superadmin';
    });
});*/

Route::group(['middleware' => ['can:create patient']], function () {
    
    Route::get('users',function (){
        return "hola";
     });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
     Route::get('/h',function (){
        return 'Hello normal user';
     });

     //Route::get('users', [UserController::class, 'index'])->name('users');

     Route::get('patients', [PatientController::class, 'index'])->name('patients');
     Route::get('patients/create', function(){
        return view('patients.create');
     })->name('createpatient');
     Route::post('patients', [PatientController::class, 'store']);

     Route::get('appointments', [AppointmentController::class, 'index'])->name('home');
     Route::get('appointments/filter', [AppointmentController::class, 'filter']);

});

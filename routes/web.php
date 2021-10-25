<?php

use Illuminate\Support\Facades\Route;
use App\Enums\UserType;

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

/*Route::prefix('superadmin')->middleware('ensureUserHasRole:'.UserType::SuperAdmin)->group(function () {
     //return 'Hello World super admin';
    Route::get('/h',function (){
        return 'Hello superadmin';
    });
});*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
     Route::get('/h',function (){
        return 'Hello normal user';
     });
});

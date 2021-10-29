<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;

class UserController extends Controller
{
    //
    public function index(){
        return User::with('roles','permissions')->get();
    }
}

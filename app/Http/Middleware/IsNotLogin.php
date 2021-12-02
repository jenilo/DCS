<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsNotLogin /*SuperAdminAuth*/
{

    private function checkIfUserIsLogin()//($user)
    {
        return Auth::check();
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->checkIfUserIsLogin()) {//(backpack_user())) {
            //return $this->respondToUnauthorizedRequest($request);
            return redirect()->route('home');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{

    private function checkIfUserHasTypeRole($role)
    {
        return Auth::user() && Auth::user()->role_id == $role;
    }

    private function respondToUnauthorizedRequest($request)
    {
        return redirect()->route('login');
    }
    public function handle(Request $request, Closure $next,$role)
    {
        if (auth()->guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }

        if (! $this->checkIfUserHasTypeRole($role)) {
            return $this->respondToUnauthorizedRequest($request);
        }

        return $next($request);
    }
}

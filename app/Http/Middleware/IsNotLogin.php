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
        return Auth::user();
    }

    public function handle(Request $request, Closure $next)
    {
        if (auth()->guest()) {
            //return $this->respondToUnauthorizedRequest($request);
            return redirect()->route('home');
        }

        if ($this->checkIfUserIsLogin()) {//(backpack_user())) {
            //return $this->respondToUnauthorizedRequest($request);
            return redirect()->route('home');
        }
        return $next($request);
    }

    /*private function checkIfUserIsAdmin()//($user)
    {
        return Auth::user() && Auth::user()->role_id == UserType::SuperAdmin;
    }

    private function respondToUnauthorizedRequest($request)
    {
        /*if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        } else {
            return redirect()->guest(backpack_url('login'));
        }*//*
        return redirect()->route('login');
    }*/

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /*public function handle(Request $request, Closure $next)
    {
        if (auth()->guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }

        if (! $this->checkIfUserIsAdmin()) {//(backpack_user())) {
            return $this->respondToUnauthorizedRequest($request);
        }

        return $next($request);
    }*/
}

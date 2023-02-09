<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){

            if(Auth::user()->role->role_name === 'Admin'){

                return $next($request);

            }else{
                return redirect()->route('home')->with('fail', __('auth.unauthorized'));
            }

        }else{
            return redirect()->route('welcome')->with('fail', __('auth.guest'));
        }
    }
}

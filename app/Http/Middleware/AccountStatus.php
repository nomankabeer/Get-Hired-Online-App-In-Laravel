<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag as MessageBag;

class AccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->account_status == User::accountActive){
            return $next($request);
        }
        Auth::logout();
        return redirect('/login')->withErrors(['msg' => 'Your Account Is Restricted. Please Contact to Customer Support.']);
    }
}

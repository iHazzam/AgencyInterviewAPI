<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Admin {

    public function handle($request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->isAdmin() )
        {
            return $next($request);
        }

        return redirect('/')->with('status', 'You need to be an administrator to access this part of the site!');

    }

}
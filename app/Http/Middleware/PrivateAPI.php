<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class PrivateAPI {

    public function handle($request, Closure $next)
    {
        $qs = $request->all();
        if((array_key_exists('key',$qs)&&(array_key_exists('email',$qs)))) {
            if (DB::table('user')->where('email','=',$qs['email'])->where('api_token','=',$qs['key'])->exists()) {
                return $next($request);
            }
        }
        abort(401,'Private API requires administrator privilege');

    }

}
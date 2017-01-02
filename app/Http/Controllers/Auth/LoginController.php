<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends \App\Http\Controllers\APIController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function logInAPI(Request $request)
    {
        $qs = $request->all();
        if((array_key_exists("email",$qs) )&&(array_key_exists("password",$qs)))
        {
            $user = User::where('email', '=', $qs['email'])->first();
            if(Auth::attempt(['email' => $qs['email'], 'password' => $qs['password']]))
            {
                return $this->respond200($user->api_token);
            }
            else{
                return $this->respond401("Invalid password entered");
            }
        }
        else{
            return $this->respond400("Must provide username and password");
        }
    }
}

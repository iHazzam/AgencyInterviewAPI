<?php

namespace App\Http\Controllers\Auth;


use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Property;
use Faker\Factory as Faker;

class RegisterController extends \App\Http\Controllers\APIController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => str_random(60)
        ]);
        for($i = 0;$i<3; $i++)
        {
            $this->createProperty($user->id);
        }
        return $user;

    }

    public function newUserAPI(Request $request)
    {
        $qs = $request->all();
        $validator = Validator::make($request->all(),[
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:3',

        ]);
        if($validator->fails())
        {
            return $this->respond400($validator->errors()->first());
            //return correct json errors
        }
        else{
            $user = User::create([
                'name' => $qs['name'],
                'email' => $qs['email'],
                'password' => bcrypt($qs['password']),
                'api_token' =>  str_random(60)
            ]);
            for($i = 0;$i<3; $i++)
            {
                $this->createProperty($user->id);
            }
            return $this->respond200("Success!");
        }
    }

    public function createProperty($uid)
    {
        $faker = Faker::create();
        $json = json_decode(file_get_contents('https://api.postcodes.io/random/postcodes'), true);
        Property::create([
            'uid' => $uid,
            'name' => $faker->secondaryAddress,
            'lat' => $json['result']['latitude'],
            'lng' => $json['result']['longitude'],
            'value' => $faker->randomFloat(2,0,9999999)
        ]);

    }





}

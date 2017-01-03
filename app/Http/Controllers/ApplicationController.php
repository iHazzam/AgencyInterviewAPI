<?php

namespace App\Http\Controllers;

use App\Property;
use App\User;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showWelcome()
    {
        return view('home');
    }

    /**
     * Show the application API management page (Vue components)
     *
     * @return \Illuminate\Http\Response
     */
    public function manageAPI()
    {
        return view('manageapi');
    }

    public function map()
    {
        return view('map');
    }
}
//
//$properties_collection = Property::all();
////name,value,owner,lati,lngi
//$properties = array();
//foreach ($properties_collection as $i => $p) {
//    $temp['name'] = $p->name;
//    $temp['value'] = $p->value;
//    $user = User::where('id', '=', $p->uid)->first();
//    $temp['owner'] = $user->name;
//    $temp['lati'] = $p->lat;
//    $temp['lngi'] = $p->lng;
//    $properties[] = $temp;
//}
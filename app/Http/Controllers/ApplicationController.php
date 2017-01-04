<?php

namespace App\Http\Controllers;

use App\Property;
use App\User;
use Illuminate\Http\Request;

//Handles routes for the web app. Completely unnecessary for this application as all logic handled via API calls to my
//Own api but in future logic could go in here if required.
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
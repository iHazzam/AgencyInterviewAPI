<?php

namespace App\Http\Controllers;

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



}

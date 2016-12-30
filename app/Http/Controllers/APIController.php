<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    //not found
    public function respond404($message = "Resource not found on system")
    {
        return response()->json([
           'error_message' => $message,
            'status' => 404
        ]);
    }
    //not authorised
    public function respond401($message = "Unauthorised to perform action")
    {
        return response()->json([
            'error_message' => $message,
            'status' => 401
        ]);
    }
    //internal error
    public function respond500($message = "Internal Server Error")
    {
        return response()->json([
            'error_message' => $message,
            'status' => 500
        ]);
    }
    //Success!
    public function respond200($data)
    {
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }


}

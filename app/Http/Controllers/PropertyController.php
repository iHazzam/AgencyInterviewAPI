<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //GET
    public function getProperties()
    {
        return "hey properties are here";
    }
    public function getPropertiesByUID($id)
    {
        $propertylist = Property::where('uid','=',$id)->get();
        if (!$propertylist)//no properties found
        {
            return response()->json([
                'error' => [
                    'message' => 'No Properties Found'
                ]
            ], 404);
        }
        else{
            return response()->json([
                $propertylist->toJson()
            ], 200);
        }
    }
    public function getPropertiesInRad($lat, $long, $rad)
    {

    }

    //POST
    public function updateProperty($pid, $key)
    {

    }
}

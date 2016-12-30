<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PropertyController extends APIController
{
    //GET
    public function getProperties()
    {
        return $this->respond404(Property::paginate(20));
    }
    public function getPropertiesByUID($id)
    {

        $propertylist = Property::where('uid','=',$id)->get();

        if (!empty($propertylist))//no properties found
        {
            return $this->respond404("No properties found!");//not found
        }
        else{
            return $this->respond200($propertylist);//what to turn into json response
        }
    }
    public function getPropertiesInRad($lat, $long, $rad)
    {
        $propertylist = DB::select(DB::raw('SELECT pid, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $long . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance FROM properties HAVING distance < ' . $rad . ' ORDER BY distance') );
        dd($propertylist);
    }

    //POST
    public function updateProperty($pid, $key)
    {

    }
}

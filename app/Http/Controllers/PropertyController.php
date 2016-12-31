<?php

namespace App\Http\Controllers;

use App\Property;
use App\User;
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

        if (empty($propertylist))//no properties found
        {
            return $this->respond404("No properties found!");//not found
        }
        else{
            return $this->respond200($propertylist);//what to turn into json response
        }
    }
    public function getPropertiesInRad($lat, $long, $rad)
    {
        try{
            $propertylist = DB::select(DB::raw('SELECT pid, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $long . ') ) + sin( radians(' . $lat . ') ) * sin( radians(lat) ) ) ) AS distance FROM properties HAVING distance < ' . $rad . ' ORDER BY distance'));
        }
        catch(\Exception $e)
        {
            return $this->respond500();
        }
        if (empty($propertylist))//no properties found
        {
            return $this->respond404("No properties found in radius!");//not found
        }
        else{
            return $this->respond200($propertylist);//what to turn into json response
        }
    }

    //POST
    public function updateProperty($pid, Request $request)
    {
        $qs = $request->all();
        if(array_key_exists('key',$qs))
        {
            $property = Property::where('pid','=', $pid)->first();
        if(empty($property)) {
            return $this->respond404("Property does not exist");
        }
        else{
            $user = User::where('id', '=', $property->uid)->first();
            $key = $qs['key'];
            if ($key != $user->key) {
                return $this->respond401("You do not own the property you are trying to update");
            }
            else{

                if(array_key_exists('lat',$qs)){
                    $property->lat = $qs['lat'];
                }
                if(array_key_exists('lng',$qs)){
                    $property->lng = $qs['lat'];
                } if(array_key_exists('val',$qs)){
                    $property->value = $qs['val'];
                }
            }
        }
        }
        else{
            return $this->respond401("No key provided");
        }
//

    }
}

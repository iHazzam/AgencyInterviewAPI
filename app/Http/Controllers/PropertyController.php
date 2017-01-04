<?php

namespace App\Http\Controllers;

use App\Property;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PropertyController extends APIController
{
    //get properties
    public function getProperties()
    {
        return $this->respond200(Property::all());
    }
    //Unused: future use will return paginated properties as opposed to all of them
    public function getPropertiesPaginated($request)
    {
        $qs = $request->all();
        if(array_key_exists('perpage',$qs))
        {
            return $this->respond200(Property::paginate($qs['perpage']));
        }
        else{
            return $this->respond200(Property::paginate(20));//default
        }
    }
    //get all properties belonging to a user
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
    //get all properties in specified radius (latitude, longitude, radius in miles)
    public function getPropertiesInRad($lat, $long, $rad)
    {
        try{
            $propertylist1 = DB::select(DB::raw('SELECT pid, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $long . ') ) + sin( radians(' . $lat . ') ) * sin( radians(lat) ) ) ) AS distance FROM properties HAVING distance < ' . $rad . ' ORDER BY distance'));

            $propertyarray = array();
            foreach($propertylist1 as $p)
            {
                $propertyarray[] = Property::where('pid','=',$p->pid)->first();
            }
             $propertylist = $propertyarray;
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

    //update a property owned by a specific user who is making the request
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
                if ($key != $user->api_token) {
                    return $this->respond401("You do not own the property you are trying to update");
                }
                else{
                    $responsestr = "";
                    if((array_key_exists('lat',$qs))||(array_key_exists('lng',$qs))||(array_key_exists('val',$qs)) )
                    {
                        if(array_key_exists('lat',$qs)){
                            $property->lat = $qs['lat'];
                            $responsestr = $responsestr . " Latitude Updated,";
                        }
                        if(array_key_exists('lng',$qs)){
                            $property->lng = $qs['lng'];
                            $responsestr = $responsestr . " Longitude Updated,";
                        } if(array_key_exists('val',$qs)){
                        $property->value = $qs['val'];
                        $responsestr = $responsestr . " Value Updated,";
                        }
                        rtrim($responsestr, ",");
                    }
                    else{
                        $responsestr = "No values updated";
                    }
                    return $this->respond200($responsestr);
                }
            }
        }
        else{
            return $this->respond401("No key provided");
        }
//

    }
}

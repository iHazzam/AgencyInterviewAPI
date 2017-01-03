<?php

namespace App\Http\Controllers;

use App\Property;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PropertyController extends APIController
{
    //GET
    public function getUsers()
    {
        $users_coll = Users::all();
        $users = array();
        foreach($users_coll as $user)
        {
            $users[$user->id] = $user->name;
        }
        return $this->respond200($users);
    }

}

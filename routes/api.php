<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Test Method
//Method: GET
//URL Endpoint: /api/test
//Parameters: none
//Success: "hello world" (string)
Route::get('/test', function () {
    return "hello world";
});


//API 1 (public) group
Route::group(['prefix' => '/public/'], function(){

        //API method to create new user
        //Method: POST
        //URL Endpoint: /api/public/user/create
        //Parameters: ?name={any string}&email={valid, unique email}&password={valid password >= 3 chars}
        //Success: {"data":"Success!","status":200} (JSON)
        Route::post('/user/create', 'Auth\RegisterController@newUserAPI');


        //API "login" method returning your API key
        //Method: GET
        //URL Endpoint: /api/public/user/login
        //Parameters: ?email={registered email}&password={valid password}
        //Success: {"data":"{YOUR API KEY HERE}","status":200}
        Route::get('/user/login', 'Auth\LoginController@logInAPI');

        //Get all properties on the system
        //Method: GET
        //URL Endpoint: /api/public/properties
        //Parameters: none
        //Success: {"data":[{"pid":X,"uid":Y,"name":"string","lat":float,"lng":float,"value":"float"}],"status":200} (Array of all properties)
        //Comments: For use in production system, this could be paginated (or @getPropertiesPaginated with param of {perpage} would be created
        //as on a production system this could return thousands of properties
        Route::get('/properties', 'PropertyController@getProperties');

        //Get all properties on the system belonging to a specific user
        //Method: GET
        //URL Endpoint: /api/public/properties/uid/{id}
        //Parameters: {id} - the system uid for that user (Users:ID in DB)
        //Success: {"data":[{"pid":X,"uid":Y,"name":"string","lat":float,"lng":float,"value":"float"}],"status":200} (Array of all properties)
        Route::get('/properties/uid/{id}', 'PropertyController@getPropertiesByUID');

        //Get all properties on the system in a specified geographical area
        //Method: GET
        //URL Endpoint: /api/public/properties/rad/{lat}/{long}/{rad}
        //Parameters: {rad} - radius of search in miles {lat} {long} - valid latitude and longitude
        //Success: {"data":[{"pid":X,"uid":Y,"name":"string","lat":float,"lng":float,"value":"float"}],"status":200} (Array of all properties)
        Route::get('/properties/rad/{lat}/{long}/{rad}', 'PropertyController@getPropertiesInRad');

        //Get all users on system mapped to their UIDs
        //Method: GET
        //URL Endpoint: /api/public/users
        //Parameters: none
        //Success: {"data":{"1":"First User Name","2":"Second User Name"},"status":200} (List of all users on system)
        Route::get('/users', 'UserController@getUsers');


        //Update one of your own properties
        //Method: POST
        //URL Endpoint: /api/public/properties/update/{pid}
        //Parameters: {PID} - valid property ID (found on map view)
        //            ?lat={valid (new) latitude}&lng={valid (new) longitude}&val={value of property}&key={API key of the owner of the property only}
        //Success: {"data":"VAL updated","status":200} (VAL is which values were updated)
        Route::post('/properties/update/{pid}','PropertyController@updateProperty');


});
//API 2 (private) group
//TBC: building a private internal API for management functions (no time!)
Route::group(['prefix' => '/private/', 'middleware' => 'privateapi'], function(){
    Route::get('/admin/list', 'UserController@getListOfAdminUsers');//must have email and key in query string

});
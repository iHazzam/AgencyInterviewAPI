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
Route::get('/test', function () {
    return "hello world";
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

//API 1 (public) group
Route::group(['prefix' => '/public/'], function(){
    //GET: Login returns api key
        Route::get('/user/login', 'Auth\LoginController@logInAPI');

    //GET: List of properties
        Route::get('/properties', 'PropertyController@getProperties');

    //GET: Properties of user (id)
        Route::get('/properties/uid/{id}', 'PropertyController@getPropertiesByUID');

    //GET: Properties in radius(Lat, long, rad)
        Route::get('/properties/rad/{lat}/{long}/{rad}', 'PropertyController@getPropertiesInRad');

    //GET: List of users and UIDs (to convert between them)
        Route::get('/users', 'UserController@getUsers');

    //POST: Create user
        Route::post('/user/create', 'Auth\RegisterController@newUserAPI');

    //POST: update property (pid, key)
        Route::post('/properties/update/{pid}','PropertyController@updateProperty');


});
//API 2 (private) group

Route::group(['prefix' => '/private/', 'middleware' => 'privateapi'], function(){
    Route::get('/admin/list', 'UserController@getListOfAdminUsers');//must have email and key in query string

});
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'api\AuthController@login');

Route::apiResource('roles', 'api\RoleController');

Route::post('register', 'api\AuthController@register');

Route::group(['middleware' => 'auth:api'], function(){

	Route::post('logout', 'api\AuthController@logout');

	Route::apiResource('users', 'api\UserController');

	Route::apiResource('patients', 'api\PatientController');

	Route::get('typeOfRooms', 'api\TypeOfRoomController@index');
	Route::post('typeOfRooms', 'api\TypeOfRoomController@store');
	Route::get('typeOfRooms/{typeOfCharge}', 'api\TypeOfRoomController@show');
	Route::put('typeOfRooms/{typeOfCharge}', 'api\TypeOfRoomController@update');
	Route::delete('typeOfRooms/{typeOfCharge}', 'api\TypeOfRoomController@destroy');

	Route::apiResource('floors', 'api\FloorController');

	Route::apiResource('rooms', 'api\RoomController');

	Route::apiResource('patientRecords', 'api\PatientRecordController');

	Route::apiResource('dispositions', 'api\DispositionController');

	Route::apiResource('results', 'api\ResultController');

	Route::apiResource('typeOfRecords', 'api\TypeOfRecordController');

	Route::apiResource('philhealthMemberships', 'api\PhilhealthMembershipController');

	Route::apiResource('nurseNotes', 'api\NurseNoteController');

	Route::apiResource('medicationAndTreatments', 'api\MedicationAndTreatmentController');

	Route::apiResource('vitalSigns', 'api\VitalSignController');

});

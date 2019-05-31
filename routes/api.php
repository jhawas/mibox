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

	Route::apiResource('intravenousFluids', 'api\IntravenousFluidController');

	Route::get('diagnoses', 'api\DiagnoseController@index');
	Route::post('diagnoses', 'api\DiagnoseController@store');
	Route::get('diagnoses/{diagnose}', 'api\DiagnoseController@show');
	Route::put('diagnoses/{diagnose}', 'api\DiagnoseController@update');
	Route::delete('diagnoses/{diagnose}', 'api\DiagnoseController@destroy');

	Route::get('patientDiagnoses', 'api\PatientDiagnoseController@index');
	Route::post('patientDiagnoses', 'api\PatientDiagnoseController@store');
	Route::get('patientDiagnoses/{patientDiagnose}', 'api\PatientDiagnoseController@show');
	Route::put('patientDiagnoses/{patientDiagnose}', 'api\PatientDiagnoseController@update');
	Route::delete('patientDiagnoses/{patientDiagnose}', 'api\PatientDiagnoseController@destroy');

	Route::apiResource('doctorsOrders', 'api\DoctorsOrderController');

	Route::get('typeOfLaboratories', 'api\TypeOfLaboratoryController@index');
	Route::post('typeOfLaboratories', 'api\TypeOfLaboratoryController@store');
	Route::get('typeOfLaboratories/{typeOfCharge}', 'api\TypeOfLaboratoryController@show');
	Route::put('typeOfLaboratories/{typeOfCharge}', 'api\TypeOfLaboratoryController@update');
	Route::delete('typeOfLaboratories/{typeOfCharge}', 'api\TypeOfLaboratoryController@destroy');

	Route::apiResource('laboratories', 'api\LaboratoryController');

	Route::apiResource('discounts', 'api\DiscountController');

	Route::apiResource('insurances', 'api\InsuranceController');

	Route::apiResource('billings', 'api\BillingController');

	Route::get('billings/patientRecord/{patient_record_id}', 'api\BillingController@dataByRecord')->name('billings.databyRecord');

	Route::apiResource('typeOfCharges', 'api\TypeOfChargeController');

	Route::apiResource('types', 'api\TypeController');

});

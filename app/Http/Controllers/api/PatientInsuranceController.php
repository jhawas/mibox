<?php

namespace App\Http\Controllers\api;

use App\PatientInsurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'insurance_id' => 'required|not_in:0',
            'amount' => 'required',
        ]);

        $patientInsurance = new PatientInsurance;
        $patientInsurance->patient_record_id = $request->patient_record_id;
        $patientInsurance->insurance_id = $request->insurance_id;
        $patientInsurance->amount = $request->amount;
        $patientInsurance->user_id = \Auth::user()->id;
        $patientInsurance->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientInsurance  $patientInsurance
     * @return \Illuminate\Http\Response
     */
    public function show(PatientInsurance $patientInsurance)
    {
        return $patientInsurance;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientInsurance  $patientInsurance
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientInsurance $patientInsurance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientInsurance  $patientInsurance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientInsurance $patientInsurance)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'insurance_id' => 'required|not_in:0',
            'amount' => 'required',
        ]);
        
        $patientInsurance->patient_record_id = $request->patient_record_id;
        $patientInsurance->insurance_id = $request->insurance_id;
        $patientInsurance->amount = $request->amount;
        $patientInsurance->user_id = \Auth::user()->id;
        $patientInsurance->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientInsurance  $patientInsurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientInsurance $patientInsurance)
    {
        $patientInsurance->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display a listing of the resource by record.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataByRecord($patient_record_id)
    {
        $patientInsurances = PatientInsurance::where('patient_record_id', $patient_record_id)
            ->get();
        return $patientInsurances;
    }
}

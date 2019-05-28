<?php

namespace App\Http\Controllers\api;

use App\PatientDiagnose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientDiagnoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientDiagnoses = PatientDiagnose::all();
        return $patientDiagnoses;
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
        $patientDiagnose = new PatientDiagnose;
        $patientDiagnose->patient_record_id = $request->patient_record_id;
        $patientDiagnose->diagnose_id = $request->diagnose_id;
        $patientDiagnose->description = $request->description;
        $patientDiagnose->remarks = $request->remarks;
        $patientDiagnose->user_id = \Auth::user()->id;
        $patientDiagnose->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientDiagnose  $patientDiagnose
     * @return \Illuminate\Http\Response
     */
    public function show(PatientDiagnose $patientDiagnose)
    {
        return $patientDiagnose;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientDiagnose  $patientDiagnose
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientDiagnose $patientDiagnose)
    {
        return $patientDiagnose;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientDiagnose  $patientDiagnose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientDiagnose $patientDiagnose)
    {
        $patientDiagnose->patient_record_id = $request->patient_record_id;
        $patientDiagnose->diagnose_id = $request->diagnose_id;
        $patientDiagnose->description = $request->description;
        $patientDiagnose->remarks = $request->remarks;
        $patientDiagnose->user_id = \Auth::user()->id;
        $patientDiagnose->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientDiagnose  $patientDiagnose
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientDiagnose $patientDiagnose)
    {
        $patientDiagnose->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}

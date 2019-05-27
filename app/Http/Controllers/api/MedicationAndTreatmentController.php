<?php

namespace App\Http\Controllers\api;

use App\MedicationAndTreatment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicationAndTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicationAndTreatments = MedicationAndTreatment::all();
        return $medicationAndTreatments;
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
            'date' => 'required',
            'time' => 'required',
            'medicine' => 'required',
            'remarks' => 'required',
        ]);

        $medicationAndTreatment = new MedicationAndTreatment;
        $medicationAndTreatment->patient_record_id = $request->patient_record_id;
        $medicationAndTreatment->medicine = $request->medicine;
        $medicationAndTreatment->date = $request->date;
        $medicationAndTreatment->time = $request->time;
        $medicationAndTreatment->remarks = $request->remarks;
        $medicationAndTreatment->user_id = \Auth::user()->id;
        $medicationAndTreatment->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicationAndTreatment  $medicationAndTreatment
     * @return \Illuminate\Http\Response
     */
    public function show(MedicationAndTreatment $medicationAndTreatment)
    {
        return $medicationAndTreatment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicationAndTreatment  $medicationAndTreatment
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicationAndTreatment $medicationAndTreatment)
    {
        return $medicationAndTreatment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicationAndTreatment  $medicationAndTreatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicationAndTreatment $medicationAndTreatment)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'date' => 'required',
            'time' => 'required',
            'medicine' => 'required',
            'remarks' => 'required',
        ]);
        
        $medicationAndTreatment->patient_record_id = $request->patient_record_id;
        $medicationAndTreatment->medicine = $request->medicine;
        $medicationAndTreatment->date = $request->date;
        $medicationAndTreatment->time = $request->time;
        $medicationAndTreatment->remarks = $request->remarks;
        $medicationAndTreatment->user_id = \Auth::user()->id;
        $medicationAndTreatment->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicationAndTreatment  $medicationAndTreatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicationAndTreatment $medicationAndTreatment)
    {
        $medicationAndTreatment->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\MedicationAndTreatment;
use App\Billing;
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
     * Display a listing of the resource by showByPatientId.
     *
     * @return \Illuminate\Http\Response
     */
    public function showByPatientId($id)
    {
        $medicationAndTreatments = MedicationAndTreatment::where('patient_record_id', $id)->get();
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
            'type_of_charge_id' => 'required|not_in:0',
            'remarks' => 'required',
            'quantity' => 'required|not_in:0',
        ]);

        $medicationAndTreatment = new MedicationAndTreatment;
        $medicationAndTreatment->patient_record_id = $request->patient_record_id;
        $medicationAndTreatment->type_of_charge_id = $request->type_of_charge_id;
        $medicationAndTreatment->date = $request->date;
        $medicationAndTreatment->time = $request->time;
        $medicationAndTreatment->remarks = $request->remarks;
        $medicationAndTreatment->quantity = $request->quantity;
        $medicationAndTreatment->user_id = \Auth::user()->id;
        $medicationAndTreatment->save();

        $billing = new Billing;
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->patient_record_id = $request->patient_record_id;
        $billing->amount = $request->price;
        $billing->quantity_and_days = $request->quantity;
        $billing->total = $request->price * $request->quantity;
        $billing->user_id = \Auth::user()->id;

        $medicationAndTreatment->billing()->save($billing);

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
            'type_of_charge_id' => 'required|not_in:0',
            'remarks' => 'required',
            'quantity' => 'required|not_in:0',
        ]);
        
        $medicationAndTreatment->patient_record_id = $request->patient_record_id;
        $medicationAndTreatment->type_of_charge_id = $request->type_of_charge_id;
        $medicationAndTreatment->date = $request->date;
        $medicationAndTreatment->time = $request->time;
        $medicationAndTreatment->remarks = $request->remarks;
        $medicationAndTreatment->quantity = $request->quantity;
        $medicationAndTreatment->user_id = \Auth::user()->id;
        $medicationAndTreatment->save();

        $billing = Billing::where('medication_and_treatment_id', $medicationAndTreatment->id);
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->patient_record_id = $request->patient_record_id;
        $billing->amount = $request->price;
        $billing->quantity_and_days = $request->quantity;
        $billing->total = $request->price * $request->quantity;
        $billing->user_id = \Auth::user()->id;

        $medicationAndTreatment->billing()->update([
            'patient_record_id' => $request->patient_record_id,
            'type_of_charge_id' => $request->type_of_charge_id,
            'amount' => $request->price,
            'quantity_and_days' => $request->quantity,
            'total' => $request->price * $request->quantity,
            'user_id' => \Auth::user()->id,
        ]);

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

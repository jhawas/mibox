<?php

namespace App\Http\Controllers\api;

use App\Billing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = Billing::with(['typeOfCharge', 'patientRecord'])->get();

        return $billings;
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
            'type_of_charge_id' => 'required|not_in:0',
            'amount' => 'required|max:191',
            'quantity_and_days' => 'required|max:191|not_in:0',
            'description' => 'required|max:191',
        ]);

        $billing = new Billing;
        $billing->patient_record_id = $request->patient_record_id;
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->amount = $request->amount;
        $billing->quantity_and_days = $request->quantity_and_days;
        $billing->total = $request->amount * $request->quantity_and_days;
        $billing->description = $request->description;
        $billing->user_id = \Auth::user()->id;
        $billing->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        return $billing->load(['typeOfCharge', 'patientRecord']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing)
    {
        return $billing;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billing $billing)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'type_of_charge_id' => 'required|not_in:0',
            'amount' => 'required|max:191',
            'quantity_and_days' => 'required|max:191|not_in:0',
            'description' => 'required|max:191',
        ]);

        $billing->patient_record_id = $request->patient_record_id;
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->amount = $request->amount;
        $billing->quantity_and_days = $request->quantity_and_days;
        $billing->total = $request->amount * $request->quantity_and_days;
        $billing->description = $request->description;
        $billing->user_id = \Auth::user()->id;
        $billing->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        $billing->delete();

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
        $billings = Billing::with(['typeOfCharge', 'patientRecord'])->where('patient_record_id', $patient_record_id)
        ->get();

        return $billings;
    }
}

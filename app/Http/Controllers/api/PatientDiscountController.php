<?php

namespace App\Http\Controllers\api;

use App\PatientDiscount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientDiscounts = PatientDiscount::all();
        return $patientDiscounts;
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
            'discount_id' => 'required|not_in:0',
            'amount' => 'required',
        ]);

        $patientDiscount = new PatientDiscount;
        $patientDiscount->patient_record_id = $request->patient_record_id;
        $patientDiscount->discount_id = $request->discount_id;
        $patientDiscount->amount = $request->amount;
        $patientDiscount->user_id = \Auth::user()->id;
        $patientDiscount->save();

        return response()->json([
            'message' => 'success',
            'patientDiscount' => $patientDiscount->load('discount'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientDiscount  $patientDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(PatientDiscount $patientDiscount)
    {
        return $patientDiscount;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientDiscount  $patientDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientDiscount $patientDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientDiscount  $patientDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientDiscount $patientDiscount)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'discount_id' => 'required|not_in:0',
            'amount' => 'required',
        ]);
        
        $patientDiscount->patient_record_id = $request->patient_record_id;
        $patientDiscount->discount_id = $request->discount_id;
        $patientDiscount->amount = $request->amount;
        $patientDiscount->user_id = \Auth::user()->id;
        $patientDiscount->save();

        return response()->json([
            'message' => 'success',
            'patientDiscount' => $patientDiscount->load('discount'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientDiscount  $patientDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientDiscount $patientDiscount)
    {
        $patientDiscount->delete();

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
        $patientDiscounts = PatientDiscount::where('patient_record_id', $patient_record_id)
            ->get();
        return $patientDiscounts;
    }
}

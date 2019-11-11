<?php

namespace App\Http\Controllers\api;

use App\Laboratory;
use App\Billing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratories =  Laboratory::whereHas('patientRecord', function($q) {
            $q->where('discharged', 0);
        })->get();
        return $laboratories;
    }

    /**
     * Display a listing of the resource by showByPatientId.
     *
     * @return \Illuminate\Http\Response
     */
    public function showByPatientId($id)
    {
        $laboratories = Laboratory::where('patient_record_id', $id)->get();
        return $laboratories;
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
            'description' => 'required',
        ]);
        
        $laboratory = new Laboratory;
        $laboratory->patient_record_id = $request->patient_record_id;
        $laboratory->type_of_charge_id = $request->type_of_charge_id;
        $laboratory->description = $request->description;
        $laboratory->images = $request->images;
        $laboratory->is_done = 1;
        $laboratory->user_id = \Auth::user()->id;
        $laboratory->save();

        $billing = new Billing;
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->patient_record_id = $request->patient_record_id;
        $billing->amount = $request->price;
        $billing->quantity_and_days = 1;
        $billing->total = $request->price;
        $billing->user_id = \Auth::user()->id;

        $laboratory->billing()->save($billing);

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratory $laboratory)
    {
        return $laboratory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function edit(Laboratory $laboratory)
    {
        return $laboratory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratory $laboratory)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'type_of_charge_id' => 'required|not_in:0',
            'description' => 'required',
        ]);
        
        $laboratory->patient_record_id = $request->patient_record_id;
        $laboratory->type_of_charge_id = $request->type_of_charge_id;
        $laboratory->description = $request->description;
        $laboratory->images = $request->images;
        $laboratory->is_done = 1;
        $laboratory->user_id = \Auth::user()->id;
        $laboratory->save();

        $billing = Billing::where('laboratory_id', $laboratory->id);
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->patient_record_id = $request->patient_record_id;
        $billing->amount = $request->price;
        $billing->quantity_and_days = 1;
        $billing->total = $request->price;
        $billing->user_id = \Auth::user()->id;

        $laboratory->billing()->update([
            'patient_record_id' => $request->patient_record_id,
            'type_of_charge_id' => $request->type_of_charge_id,
            'amount' => $request->price,
            'quantity_and_days' => 1,
            'total' => $request->price,
            'user_id' => \Auth::user()->id,
        ]);
        
        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratory $laboratory)
    {
        $laboratory->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}

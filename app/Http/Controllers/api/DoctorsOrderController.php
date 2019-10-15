<?php

namespace App\Http\Controllers\api;

use App\DoctorsOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctorsOrders = DoctorsOrder::all();
        return $doctorsOrders;
    }

    /**
     * Display a listing of the resource by showByPatientId.
     *
     * @return \Illuminate\Http\Response
     */
    public function showByPatientId($id)
    {
        $doctorsOrders = DoctorsOrder::where('patient_record_id', $id)->get();
        return $doctorsOrders;
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
            'progress_note' => 'required',
            'orders' => 'required',
        ]);

        $doctorsOrder = new DoctorsOrder;

        $doctorsOrder->patient_record_id = $request->patient_record_id;
        $doctorsOrder->date = $request->date;
        $doctorsOrder->time = $request->time;
        $doctorsOrder->progress_note = $request->progress_note;
        $doctorsOrder->orders = $request->orders;
        $doctorsOrder->is_laboratory = $request->is_laboratory;
        $doctorsOrder->laboratories = $request->laboratories;
        $doctorsOrder->requested_by = \Auth::user()->id;
        $doctorsOrder->user_id = \Auth::user()->id;
        $doctorsOrder->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorsOrder  $doctorsOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorsOrder $doctorsOrder)
    {
        return $doctorsOrder;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorsOrder  $doctorsOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorsOrder $doctorsOrder)
    {
        return $doctorsOrder;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorsOrder  $doctorsOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorsOrder $doctorsOrder)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'date' => 'required',
            'time' => 'required',
            'progress_note' => 'required',
            'orders' => 'required',
        ]);


        $doctorsOrder->patient_record_id = $request->patient_record_id;
        $doctorsOrder->date = $request->date;
        $doctorsOrder->time = $request->time;
        $doctorsOrder->progress_note = $request->progress_note;
        $doctorsOrder->orders = $request->orders;
        $doctorsOrder->is_laboratory = $request->is_laboratory;
        $doctorsOrder->laboratories = $request->laboratories;
        $doctorsOrder->requested_by = \Auth::user()->id;
        $doctorsOrder->user_id = \Auth::user()->id;
        $doctorsOrder->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorsOrder  $doctorsOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorsOrder $doctorsOrder)
    {
        $doctorsOrder->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}

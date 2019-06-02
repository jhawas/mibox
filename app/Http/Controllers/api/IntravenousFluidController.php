<?php

namespace App\Http\Controllers\api;

use App\IntravenousFluid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Billing;

class IntravenousFluidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $intravenousFluids = IntravenousFluid::all();
        return $intravenousFluids;
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

        $intravenousFluid = new IntravenousFluid;
        $intravenousFluid->patient_record_id = $request->patient_record_id;
        $intravenousFluid->date = $request->date;
        $intravenousFluid->time = $request->time;
        $intravenousFluid->bot_no = $request->bot_no;
        $intravenousFluid->quantity = $request->quantity;
        $intravenousFluid->type_of_charge_id = $request->type_of_charge_id;
        $intravenousFluid->vol = $request->vol;
        $intravenousFluid->gtss = $request->gtss;
        $intravenousFluid->remarks = $request->remarks;
        $intravenousFluid->user_id = \Auth::user()->id;
        $intravenousFluid->save();

        $billing = new Billing;
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->patient_record_id = $request->patient_record_id;
        $billing->amount = $request->price;
        $billing->quantity_and_days = $request->quantity;
        $billing->total = $request->price * $request->quantity;
        $billing->user_id = \Auth::user()->id;

        $intravenousFluid->billing()->save($billing);

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IntravenousFluid  $intravenousFluid
     * @return \Illuminate\Http\Response
     */
    public function show(IntravenousFluid $intravenousFluid)
    {
        return $intravenousFluid;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IntravenousFluid  $intravenousFluid
     * @return \Illuminate\Http\Response
     */
    public function edit(IntravenousFluid $intravenousFluid)
    {
        return $intravenousFluid;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IntravenousFluid  $intravenousFluid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IntravenousFluid $intravenousFluid)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'date' => 'required',
            'time' => 'required',
            'type_of_charge_id' => 'required|not_in:0',
            'remarks' => 'required',
            'quantity' => 'required|not_in:0',
        ]);
        
        $intravenousFluid->patient_record_id = $request->patient_record_id;
        $intravenousFluid->date = $request->date;
        $intravenousFluid->time = $request->time;
        $intravenousFluid->bot_no = $request->bot_no;
        $intravenousFluid->quantity = $request->quantity;
        $intravenousFluid->type_of_charge_id = $request->type_of_charge_id;
        $intravenousFluid->vol = $request->vol;
        $intravenousFluid->gtss = $request->gtss;
        $intravenousFluid->remarks = $request->remarks;
        $intravenousFluid->user_id = \Auth::user()->id;
        $intravenousFluid->save();

        $billing = Billing::where('intravenous_fluid_id', $intravenousFluid->id);
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->patient_record_id = $request->patient_record_id;
        $billing->amount = $request->price;
        $billing->quantity_and_days = $request->quantity;
        $billing->total = $request->price * $request->quantity;
        $billing->user_id = \Auth::user()->id;

        $intravenousFluid->billing()->update([
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
     * @param  \App\IntravenousFluid  $intravenousFluid
     * @return \Illuminate\Http\Response
     */
    public function destroy(IntravenousFluid $intravenousFluid)
    {
        $intravenousFluid->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}

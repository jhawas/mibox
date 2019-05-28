<?php

namespace App\Http\Controllers\api;

use App\IntravenousFluid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'bot_no' => 'required',
            'kind_of_solution' => 'required',
            'vol' => 'required',
            'gtss' => 'required',
            'remarks' => 'required',
        ]);

        $intravenousFluid = new IntravenousFluid;
        $intravenousFluid->patient_record_id = $request->patient_record_id;
        $intravenousFluid->date = $request->date;
        $intravenousFluid->time = $request->time;
        $intravenousFluid->bot_no = $request->bot_no;
        $intravenousFluid->kind_of_solution = $request->kind_of_solution;
        $intravenousFluid->vol = $request->vol;
        $intravenousFluid->gtss = $request->gtss;
        $intravenousFluid->remarks = $request->remarks;
        $intravenousFluid->user_id = \Auth::user()->id;
        $intravenousFluid->save();

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
            'bot_no' => 'required',
            'kind_of_solution' => 'required',
            'vol' => 'required',
            'gtss' => 'required',
            'remarks' => 'required',
        ]);
        
        $intravenousFluid->patient_record_id = $request->patient_record_id;
        $intravenousFluid->date = $request->date;
        $intravenousFluid->time = $request->time;
        $intravenousFluid->bot_no = $request->bot_no;
        $intravenousFluid->kind_of_solution = $request->kind_of_solution;
        $intravenousFluid->vol = $request->vol;
        $intravenousFluid->gtss = $request->gtss;
        $intravenousFluid->remarks = $request->remarks;
        $intravenousFluid->user_id = \Auth::user()->id;
        $intravenousFluid->save();

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

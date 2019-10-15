<?php

namespace App\Http\Controllers\api;

use App\VitalSign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VitalSignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vitalSigns = VitalSign::all();
        return $vitalSigns;
    }

    /**
     * Display a listing of the resource by showByPatientId.
     *
     * @return \Illuminate\Http\Response
     */
    public function showByPatientId(VitalSign $vitalSign)
    {
        $vitalSigns = VitalSign::where('patient_record_id', $vitalSign->patient_record_id)->get();
        return $vitalSigns;
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
            'bp' => 'required',
            't' => 'required',
            'p' => 'required',
            'r' => 'required',
            'intake_oral' => 'required',
            'intake_iv' => 'required',
            'intake_ng' => 'required',
            'output_urine' => 'required',
            'output_stool' => 'required',
            'output_emesis' => 'required',
            'output_ng' => 'required',
        ]);

        $vitalSign = new VitalSign;
        $vitalSign->patient_record_id = $request->patient_record_id;
        $vitalSign->date = $request->date;
        $vitalSign->time = $request->time;
        $vitalSign->bp = $request->bp;
        $vitalSign->t = $request->t;
        $vitalSign->p = $request->p;
        $vitalSign->r = $request->r;
        $vitalSign->intake_oral = $request->intake_oral;
        $vitalSign->intake_iv = $request->intake_iv;
        $vitalSign->intake_ng = $request->intake_ng;
        $vitalSign->total_intake = ($request->intake_oral + $request->intake_iv + $request->intake_ng);
        $vitalSign->output_urine = $request->output_urine;
        $vitalSign->output_stool = $request->output_stool;
        $vitalSign->output_emesis = $request->output_emesis;
        $vitalSign->output_ng = $request->output_ng;
        $vitalSign->total_output = ($request->output_urine + $request->output_stool + $request->output_emesis + $request->output_ng);
        $vitalSign->user_id = \Auth::user()->id;
        $vitalSign->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function show(VitalSign $vitalSign)
    {
        return $vitalSign;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function edit(VitalSign $vitalSign)
    {
        return $vitalSign;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VitalSign $vitalSign)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'date' => 'required',
            'time' => 'required',
            'bp' => 'required',
            't' => 'required',
            'p' => 'required',
            'r' => 'required',
            'intake_oral' => 'required',
            'intake_iv' => 'required',
            'intake_ng' => 'required',
            'output_urine' => 'required',
            'output_stool' => 'required',
            'output_emesis' => 'required',
            'output_ng' => 'required',
        ]);
        
        $vitalSign->patient_record_id = $request->patient_record_id;
        $vitalSign->date = $request->date;
        $vitalSign->time = $request->time;
        $vitalSign->bp = $request->bp;
        $vitalSign->t = $request->t;
        $vitalSign->p = $request->p;
        $vitalSign->r = $request->r;
        $vitalSign->intake_oral = $request->intake_oral;
        $vitalSign->intake_iv = $request->intake_iv;
        $vitalSign->intake_ng = $request->intake_ng;
        $vitalSign->total_intake = ($request->intake_oral + $request->intake_iv + $request->intake_ng);
        $vitalSign->output_urine = $request->output_urine;
        $vitalSign->output_stool = $request->output_stool;
        $vitalSign->output_emesis = $request->output_emesis;
        $vitalSign->output_ng = $request->output_ng;
        $vitalSign->total_output = ($request->output_urine + $request->output_stool + $request->output_emesis + $request->output_ng);
        $vitalSign->user_id = \Auth::user()->id;
        $vitalSign->save();
        
        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function destroy(VitalSign $vitalSign)
    {
        $vitalSign->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}

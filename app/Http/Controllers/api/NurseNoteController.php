<?php

namespace App\Http\Controllers\api;

use App\NurseNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NurseNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nurseNotes = NurseNote::all();
        return $nurseNotes;
    }

    /**
     * Display a listing of the resource by showByPatientId.
     *
     * @return \Illuminate\Http\Response
     */
    public function showByPatientId(NurseNote $nurseNote)
    {
        $nurseNotes = NurseNote::where('patient_record_id', $nurseNote->patient_record_id)->get();
        return $nurseNotes;
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
            'focus' => 'required',
            'action_response' => 'required',
        ]);

        $nurseNote = new NurseNote;
        $nurseNote->patient_record_id = $request->patient_record_id;
        $nurseNote->date = $request->date;
        $nurseNote->time = $request->time;
        $nurseNote->focus = $request->focus;
        $nurseNote->action_response = $request->action_response;
        $nurseNote->user_id = \Auth::user()->id;
        $nurseNote->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NurseNote  $nurseNote
     * @return \Illuminate\Http\Response
     */
    public function show(NurseNote $nurseNote)
    {
        return $nurseNote;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NurseNote  $nurseNote
     * @return \Illuminate\Http\Response
     */
    public function edit(NurseNote $nurseNote)
    {
        return $nurseNote;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NurseNote  $nurseNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NurseNote $nurseNote)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'date' => 'required',
            'time' => 'required',
            'focus' => 'required',
            'action_response' => 'required',
        ]);
        
        $nurseNote->patient_record_id = $request->patient_record_id;
        $nurseNote->date = $request->date;
        $nurseNote->time = $request->time;
        $nurseNote->focus = $request->focus;
        $nurseNote->action_response = $request->action_response;
        $nurseNote->user_id = \Auth::user()->id;
        $nurseNote->save();
        
        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NurseNote  $nurseNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(NurseNote $nurseNote)
    {
        $nurseNote->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}

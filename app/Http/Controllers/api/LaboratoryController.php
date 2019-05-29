<?php

namespace App\Http\Controllers\api;

use App\Laboratory;
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
        $laboratories =  Laboratory::all();
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
        // $validatedData = $request->validate([
        //     'name' => 'required|max:191',
        // ]);
        
        $laboratory = new Laboratory;
        $laboratory->patient_record_id = $request->patient_record_id;
        $laboratory->type_of_charge_id = $request->type_of_charge_id;
        $laboratory->description = $request->description;
        $laboratory->images = $request->images;
        $laboratory->is_done = 1;
        $laboratory->user_id = \Auth::user()->id;
        $laboratory->save();

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
        $laboratory->patient_record_id = $request->patient_record_id;
        $laboratory->type_of_charge_id = $request->type_of_charge_id;
        $laboratory->description = $request->description;
        $laboratory->images = $request->images;
        $laboratory->is_done = 1;
        $laboratory->user_id = \Auth::user()->id;
        $laboratory->save();
        
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

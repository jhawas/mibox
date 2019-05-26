<?php

namespace App\Http\Controllers\api;

use App\TypeOfCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeOfCharges = TypeOfCharge::with(['parent'])->where('type_id', 3)->get();

        return $typeOfCharges;
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
            'name' => 'required|max:191',
            'price' => 'required|max:191',
        ]);

        $typeOfCharge = new TypeOfCharge;
        $typeOfCharge->name = $request->name;
        $typeOfCharge->price = $request->price;
        $typeOfCharge->type_id = 3; //room types
        $typeOfCharge->user_id = \Auth::user()->id;
        $typeOfCharge->save();

        return response()->json([
            'message' => 'success',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function show(TypeOfCharge $typeOfCharge)
    {

        return $typeOfCharge->load('parent');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeOfCharge $typeOfCharge)
    {

        return $typeOfCharge;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeOfCharge $typeOfCharge)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:191',
            'price' => 'required|max:191',
        ]);
        
        $typeOfCharge->name = $request->name;
        $typeOfCharge->price = $request->price;
        $typeOfCharge->type_id = 3; //room types
        $typeOfCharge->user_id = \Auth::user()->id;
        $typeOfCharge->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeOfCharge $typeOfCharge)
    {

        $typeOfCharge->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
    
}

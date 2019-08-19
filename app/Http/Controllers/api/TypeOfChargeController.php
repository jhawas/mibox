<?php

namespace App\Http\Controllers\api;

use App\TypeOfCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeOfCharges = TypeOfCharge::with(['parent', 'category', 'groupOfCharge'])->get();

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
            'type_id' => 'required|not_in:0',
        ]);

        $typeOfCharge = new TypeOfCharge;
        $typeOfCharge->name = $request->name;
        $typeOfCharge->price = $request->price;
        $typeOfCharge->group_of_charge_id = $this->isDataEmpty($request->group_of_charge_id);
        $typeOfCharge->type_id = $request->type_id;
        $typeOfCharge->is_default = $request->is_default;
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
        return $typeOfCharge->load(['parent', 'category', 'groupOfCharge']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeOfCharge $typeOfCharge)
    {
        //
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
            'type_id' => 'required|not_in:0',
        ]);
        
        $typeOfCharge->name = $request->name;
        $typeOfCharge->price = $request->price;
        $typeOfCharge->group_of_charge_id = $this->isDataEmpty($request->group_of_charge_id);
        $typeOfCharge->type_id = $request->type_id;
        $typeOfCharge->is_default = $request->is_default;
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

    /**
     * Identify request if null
     *
     * @param  value
     * @return \Illuminate\Http\Response
     */
    public function isDataEmpty($value)
    {
        if($value > 0) {
            return $value;
        }
        return null;
    }

    /**
     * Display a listing of the resource by record.
     *
     * @return \Illuminate\Http\Response
     */
    public function chargeByType($type_id)
    {
        $typeOfCharge = TypeOfCharge::where('type_id', $type_id)->get();

        return $typeOfCharge;
        
    }
}

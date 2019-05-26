<?php

namespace App\Http\Controllers\api;

use App\TypeOfRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeOfRecords = TypeOfRecord::all();
        return $typeOfRecords;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeOfRecord  $typeOfRecord
     * @return \Illuminate\Http\Response
     */
    public function show(TypeOfRecord $typeOfRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeOfRecord  $typeOfRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeOfRecord $typeOfRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeOfRecord  $typeOfRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeOfRecord $typeOfRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeOfRecord  $typeOfRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeOfRecord $typeOfRecord)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\api;

use App\GroupOfCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupOfChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupOfCharges = GroupOfCharge::all();
        return $groupOfCharges;
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
     * @param  \App\GroupOfCharge  $groupOfCharge
     * @return \Illuminate\Http\Response
     */
    public function show(GroupOfCharge $groupOfCharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupOfCharge  $groupOfCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupOfCharge $groupOfCharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupOfCharge  $groupOfCharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupOfCharge $groupOfCharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupOfCharge  $groupOfCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupOfCharge $groupOfCharge)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\api;

use App\PhilhealthMembership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhilhealthMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $philhealthMemberships = PhilhealthMembership::all();
        return $philhealthMemberships;
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
     * @param  \App\PhilhealthMembership  $philhealthMembership
     * @return \Illuminate\Http\Response
     */
    public function show(PhilhealthMembership $philhealthMembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhilhealthMembership  $philhealthMembership
     * @return \Illuminate\Http\Response
     */
    public function edit(PhilhealthMembership $philhealthMembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PhilhealthMembership  $philhealthMembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhilhealthMembership $philhealthMembership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhilhealthMembership  $philhealthMembership
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhilhealthMembership $philhealthMembership)
    {
        //
    }
}

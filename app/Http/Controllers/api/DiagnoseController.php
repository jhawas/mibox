<?php

namespace App\Http\Controllers\api;

use App\Diagnose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiagnoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnoses = Diagnose::with([
            'parent'
        ])->get();
        return $diagnoses;
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
            'description' => 'required|max:191',
        ]);

        $diagnose = new Diagnose;
        $diagnose->name = $request->name;
        $diagnose->description = $request->description;
        $diagnose->parent_id = $this->isDataEmpty($request->parent_id);
        $diagnose->user_id = \Auth::user()->id;
        $diagnose->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnose $diagnose)
    {
        return $diagnose->load('parent');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnose $diagnose)
    {
        return $diagnose->load('parent');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnose $diagnose)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:191',
            'description' => 'required|max:191',
        ]);

        $diagnose->name = $request->name;
        $diagnose->description = $request->description;
        $diagnose->parent_id = $this->isDataEmpty($request->parent_id);
        $diagnose->user_id = \Auth::user()->id;
        $diagnose->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnose $diagnose)
    {
        $diagnose->delete();

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
}

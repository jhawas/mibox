<?php

namespace App\Http\Controllers\api;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with([
            'user',
            'floor',
            'typeOfRoom'
        ])->get();
        return $rooms;
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
            'capacity' => 'required|not_in:0',
            'floor' => 'required|not_in:null',
            'type_of_room' => 'required|not_in:null',
        ]);

        $room = new Room;
        $room->name = $request->name;
        $room->description = $request->description;
        $room->capacity = $request->capacity;
        $room->floor_id = $request->floor;
        $room->type_of_charge_id = $request->type_of_room;
        $room->user_id = \Auth::user()->id;
        $room->save();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return $room->load(['user', 'floor', 'typeOfRoom']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return $room->load(['user', 'floor', 'typeOfRoom']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:191',
            'description' => 'required|max:191',
            'capacity' => 'required|not_in:0',
            'floor' => 'required|not_in:null',
            'type_of_room' => 'required|not_in:null',
        ]);

        $room->name = $request->name;
        $room->description = $request->description;
        $room->capacity = $request->capacity;
        $room->floor_id = $request->floor;
        $room->type_of_charge_id = $request->type_of_room;
        $room->user_id = \Auth::user()->id;
        $room->save();

        return response()->json([
            'message' => 'success',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }
}

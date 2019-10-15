<?php

namespace App\Http\Controllers\api;

use App\PatientRoom;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PatientRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientRooms = PatientRoom::with([
            'patientRecords',
            'room',
            'patient'
        ])->get();
        return $patientRooms;
    }

    /**
     * Display a listing of the resource by showByPatientId.
     *
     * @return \Illuminate\Http\Response
     */
    public function showByPatientId($id)
    {
        $patientRooms = PatientRoom::with([
            'patientRecords',
            'room',
            'patient'
        ])->where('patient_record_id', $id)->get();
        return $patientRooms;
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
            'room_id' => 'required|not_in:0',
            'date_started' => 'required',
            'time_start' => 'required',
        ]);
        
        // update last room
        $patientCurrentRoom = PatientRoom::where('patient_record_id', $request->patient_record_id)->latest()->first();
        $patientCurrentRoom->end_date =  $request->date_started;
        $patientCurrentRoom->time_start =  $request->time_start;
        $patientCurrentRoom->save();

        $currentRoomRate = Room::roomRate($patientCurrentRoom->room_id);

        // get days in a room
        $diffDaysCurrentRoom = $this->countDaysBetween($patientCurrentRoom->date_started, $request->date_started);
        
        // update billing in a room
        $patientCurrentRoom->patientRecords()->sync([ $patientCurrentRoom->patient_record_id => [
            'type_of_charge_id' => $currentRoomRate->type_of_room_id,
            'quantity_and_days' => $diffDaysCurrentRoom,
            'amount' => $currentRoomRate->room_rate,
            'total' => $currentRoomRate->room_rate * $diffDaysCurrentRoom,
            'user_id' => \Auth::user()->id,
        ]]);

        $patientRoom = new PatientRoom;
        $patientRoom->patient_id = $request->patient_id;
        $patientRoom->patient_record_id = $request->patient_record_id;
        $patientRoom->room_id = $request->room_id;
        $patientRoom->date_started = $request->date_started;
        $patientRoom->time_start = $request->time_start;
        $patientRoom->end_date = $request->end_date;
        $patientRoom->end_time = $request->end_time;
        $patientRoom->save();

        $currentDate = Carbon::now()->toDateString();

        $diff_in_days = $this->countDaysBetween(
            $request->date_started, 
            $request->end_date ? $request->end_date : $currentDate
        );

        $roomRate = Room::roomRate($request->room_id);
        
        // add to billing
        $patientRoom->patientRecords()->attach($patientRoom->patient_record_id, [
            'type_of_charge_id' => $roomRate->type_of_room_id,
            'quantity_and_days' => $diff_in_days,
            'amount' => $roomRate->room_rate,
            'total' => $roomRate->room_rate * $diff_in_days,
            'user_id' => \Auth::user()->id,
        ]);
        
        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientRoom  $patientRoom
     * @return \Illuminate\Http\Response
     */
    public function show(PatientRoom $patientRoom)
    {
        return $patientRoom->load([
            'patientRecords',
            'room',
            'patient',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientRoom  $patientRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRoom $patientRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientRoom  $patientRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientRoom $patientRoom)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'room_id' => 'required|not_in:0',
            'date_started' => 'required',
            'time_start' => 'required',
        ]);

        $patientRoom->patient_id = $request->patient_id;
        $patientRoom->patient_record_id = $request->patient_record_id;
        $patientRoom->room_id = $request->room_id;
        $patientRoom->date_started = $request->date_started;
        $patientRoom->time_start = $request->time_start;
        $patientRoom->end_date = $request->end_date;
        $patientRoom->end_time = $request->end_time;
        $patientRoom->save();

        $currentDate = Carbon::now()->toDateString();

        $diff_in_days = $this->countDaysBetween(
            $request->date_started,
            $request->end_date ? $request->end_date : $currentDate
        );

        $roomRate = Room::roomRate($request->room_id);
        
        // add to billing
        $patientRoom->patientRecords()->sync([$patientRoom->patient_record_id => [
            'type_of_charge_id' => $roomRate->type_of_room_id,
            'quantity_and_days' => $diff_in_days,
            'amount' => $roomRate->room_rate,
            'total' => $roomRate->room_rate * $diff_in_days,
            'user_id' => \Auth::user()->id,
        ]]);

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientRoom  $patientRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRoom $patientRoom)
    {
        $patientRoom->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }

    private function countDaysBetween($startDate, $endDate)
    {
        $from = Carbon::createFromFormat('Y-m-d', $startDate);

        $to = Carbon::createFromFormat('Y-m-d', $endDate);

        return $to->diffInDays($from);
    }
}

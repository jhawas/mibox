<?php

namespace App\Http\Controllers\api;

use App\PatientRecord;
use App\PatientRoom;
use App\Billing;
use App\Room;
use App\TypeOfCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PatientRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientRecords = PatientRecord::with([
            'user',
            'patient',
            'disposition',
            'result',
            'philhealthMembership',
            'admitAndCheckBy',
            'dischargedBy',
            'physician',
            'chartCompletedBy',
            'patientRooms',
            'currentRoom',
            'rooms'
        ])->get();
        return $patientRecords;
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
            'patient_id' => 'required|not_in:0',
            'chief_complaints' => 'required',
            'brief_history' => 'required',
            'admit_and_check_by' => 'required|not_in:0',
            'admit_and_check_date' => 'required',
            'admit_and_check_time' => 'required',
            'physician_id' => 'required|not_in:0',
            'discharged_date' => $request->discharged_by > 0 ? 'required' : '',
            'discharged_time' => $request->discharged_by > 0 ? 'required' : '',
        ]);

        $patientRecord = new PatientRecord;
        $patientRecord->patient_id = $request->patient_id;
        $patientRecord->disposition_id = $this->isDataEmpty($request->disposition_id);
        $patientRecord->result_id = $this->isDataEmpty($request->result_id);
        $patientRecord->philhealth_membership_id = $this->isDataEmpty($request->philhealth_membership_id);
        $patientRecord->chief_complaints = $request->chief_complaints;
        $patientRecord->brief_history = $request->brief_history;
        $patientRecord->admit_and_check_by = $this->isDataEmpty($request->admit_and_check_by);
        $patientRecord->admit_and_check_date = $request->admit_and_check_date;
        $patientRecord->admit_and_check_time = $request->admit_and_check_time;
        $patientRecord->discharged_by = $this->isDataEmpty($request->discharged_by);
        $patientRecord->discharged_date = $request->discharged_date;
        $patientRecord->discharged_time = $request->discharged_time;
        $patientRecord->physician_id = $this->isDataEmpty($request->physician_id);
        $patientRecord->chart_completed_by = $this->isDataEmpty($request->chart_completed_by);
        $patientRecord->discharged = $request->discharged;
        $patientRecord->user_id = \Auth::user()->id;
        $patientRecord->save();

        // add to patient room
        $patientRecord->rooms()->attach($request->room_id, [
            'patient_id' => $request->patient_id,
            'date_started' => $request->admit_and_check_date,
            'time_start' => $request->admit_and_check_time,
        ]);

        // get current room
        $patientRoom = PatientRoom::currentRoom($patientRecord->id)->latest()->first();

        $roomRate = Room::roomRate($request->room_id);

        // add to billing
        $patientRecord->patientRooms()->attach($patientRoom->id, [
            'type_of_charge_id' => $roomRate->type_of_room_id,
            'quantity_and_days' => 3,
            'amount' => $roomRate->room_rate,
            'total' => $roomRate->room_rate * 3,
            'user_id' => \Auth::user()->id,
        ]);

        // fetch default charges
        $typeOfCharges = TypeOfCharge::where('is_default', 1)->get();

        // add all default charges to billing
        foreach ($typeOfCharges as $charge) {
            $patientRecord->typeOfCharges()->attach($charge->id, [
                'quantity_and_days' => 1,
                'amount' => $charge->price,
                'total' => $charge->price,
                'user_id' => \Auth::user()->id,
            ]);
        }
        
        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function show(PatientRecord $patientRecord)
    {
        return $patientRecord->load([
            'user',
            'patient',
            'disposition',
            'result',
            'philhealthMembership',
            'admitAndCheckBy',
            'dischargedBy',
            'physician',
            'chartCompletedBy',
            'currentRoom',
            'patientDiagnoses',
            'nurseNotes',
            'medicationAndTreatments',
            'vitalSigns',
            'intravenousFluids',
            'doctorsOrders',
            'laboratories',
            // 'patientRooms'
            'currentRoom',
            'rooms',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRecord $patientRecord)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientRecord $patientRecord)
    {

        $validatedData = $request->validate([
            'patient_id' => 'required|not_in:0',
            'chief_complaints' => 'required',
            'brief_history' => 'required',
            'admit_and_check_by' => 'required|not_in:0',
            'admit_and_check_date' => 'required|not_in:null',
            'admit_and_check_time' => 'required|not_in:null',
            'physician_id' => 'required|not_in:0',
            'discharged_date' => $request->discharged_by > 0 ? 'required' : '',
            'discharged_time' => $request->discharged_by > 0 ? 'required' : '',
        ]);
        
        $patientRecord->patient_id = $request->patient_id;
        $patientRecord->type_of_record_id = $this->isDataEmpty($request->type_of_record_id);
        $patientRecord->disposition_id = $this->isDataEmpty($request->disposition_id);
        $patientRecord->result_id = $this->isDataEmpty($request->result_id);
        $patientRecord->philhealth_membership_id = $this->isDataEmpty($request->philhealth_membership_id);
        $patientRecord->chief_complaints = $request->chief_complaints;
        $patientRecord->brief_history = $request->brief_history;
        $patientRecord->admit_and_check_by = $this->isDataEmpty($request->admit_and_check_by);
        $patientRecord->admit_and_check_date = $request->admit_and_check_date;
        $patientRecord->admit_and_check_time = $request->admit_and_check_time;
        $patientRecord->discharged_by = $this->isDataEmpty($request->discharged_by);
        $patientRecord->discharged_date = $this->isDataEmpty($request->discharged_date);
        $patientRecord->discharged_time = $this->isDataEmpty($request->discharged_time);
        $patientRecord->physician_id = $this->isDataEmpty($request->physician_id);
        $patientRecord->chart_completed_by = $this->isDataEmpty($request->chart_completed_by);
        $patientRecord->discharged = $request->discharged;
        $patientRecord->user_id = \Auth::user()->id;
        $patientRecord->save();

        if($request->discharged_by > 0) {
            
            $from = Carbon::createFromFormat('Y-m-d', $request->admit_and_check_date);

            $to = Carbon::createFromFormat('Y-m-d', $request->discharged_date);

            $diff_in_days = $to->diffInDays($from);

            $patientRecord->currentRoom()->update([
                'end_date' => $request->discharged_date,
                'end_time' => $request->discharged_time,
            ]);

            $patientRoom = $patientRecord->currentRoom()->first();

            $roomRate = Room::roomRate($patientRoom->room_id);

            $patientRecord->patientRooms()->syncWithoutDetaching([$patientRoom->id => [
                'quantity_and_days' => $diff_in_days,
                'amount' => $roomRate->room_rate,
                'total' => $roomRate->room_rate * $diff_in_days,
                'user_id' => \Auth::user()->id,
            ]]);


        }

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecord $patientRecord)
    {
        $patientRecord->delete();

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

    public function available() 
    {
        $patientRecords = PatientRecord::with([
            'user',
            'patient',
            'disposition',
            'result',
            'philhealthMembership',
            'admitAndCheckBy',
            'dischargedBy',
            'physician',
            'chartCompletedBy',
            'patientRooms',
            'currentRoom'
        ])->where('discharged', 0)->get();
        return $patientRecords;
    }
    
}

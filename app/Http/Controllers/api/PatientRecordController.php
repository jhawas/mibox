<?php

namespace App\Http\Controllers\api;

use App\PatientRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'typeOfRecord',
            'disposition',
            'result',
            'philhealthMembership',
            'admitAndCheckBy',
            'dischargedBy',
            'physician',
            'chartCompletedBy'
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

        $patientRecord = new PatientRecord;
        $patientRecord->patient_id = $request->patient_id;
        $patientRecord->type_of_record_id = $request->type_of_record_id;
        $patientRecord->room_id = $request->has('room_id') ? $request->room_id : null;
        $patientRecord->disposition_id = $request->disposition_id;
        $patientRecord->result_id = $request->result_id;
        $patientRecord->philhealth_membership_id = $request->philhealth_membership_id;
        $patientRecord->chief_complaints = $request->chief_complaints;
        $patientRecord->brief_history = $request->brief_history;
        $patientRecord->admit_and_check_by = $request->admit_and_check_by;
        $patientRecord->admit_and_check_date = $request->admit_and_check_date;
        $patientRecord->admit_and_check_time = $request->admit_and_check_time;
        $patientRecord->discharged_by = $request->discharged_by;
        $patientRecord->discharged_date = $request->discharged_date;
        $patientRecord->discharged_time = $request->discharged_time;
        $patientRecord->physician_id = $request->physician_id;
        $patientRecord->chart_completed_by = $request->chart_completed_by;
        $patientRecord->user_id = \Auth::user()->id;
        $patientRecord->save();

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
            'typeOfRecord',
            'disposition',
            'result',
            'philhealthMembership',
            'admitAndCheckBy',
            'dischargedBy',
            'physician',
            'chartCompletedBy'
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
        return $patientRecord->load([
            'user',
            'patient',
            'typeOfRecord',
            'disposition',
            'result',
            'philhealthMembership',
            'admitAndCheckBy',
            'dischargedBy',
            'physician',
            'chartCompletedBy'
        ]);
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

        $patientRecord->patient_id = $request->patient_id;
        $patientRecord->type_of_record_id = $this->isDataEmpty($request->type_of_record_id);
        $patientRecord->room_id = $this->isDataEmpty($request->room_id);
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
        $patientRecord->user_id = \Auth::user()->id;
        $patientRecord->save();

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
}

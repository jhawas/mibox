<?php

namespace App\Http\Controllers\api;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewPatient;
use App\User;
use App\Events\NotificationEvent;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with([
            'currentPatientRecords' => function($query) {
                $query->with('currentDiagnose');
            }
        ])->get();
        return $patients;
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
            'case_no' => 'required|max:191',
            'first_name' => 'required|max:191',
            'middle_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'suffix' => 'required|max:191',
            'birthdate' => 'required|max:191',
            'religion' => 'required|max:191',
            'sex' => 'required|max:191',
            'address' => 'required|max:191',
            'civil_status' => 'required|max:191:not_in:0',
            'father' => 'required|max:191',
            'mother' => 'required|max:191',
            'spouse' => $request->civil_status == 'married' ? 'required|max:191' : '',
            'spouse_address' => $request->civil_status == 'married' ? 'required|max:191' : '',
            'contact_no' => 'required|max:191',
            'e_name' => 'required|max:191',
            'e_contact' => 'required|max:191',
            'e_address' => 'required|max:191',
        ]);

        $patient = new Patient;
        $patient->case_no = $request->case_no;
        $patient->first_name = $request->first_name;
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->suffix = $request->suffix;
        $patient->birthdate = $request->birthdate;
        $patient->religion = $request->religion;
        $patient->sex = $request->sex;
        $patient->address = $request->address;
        $patient->civil_status = $request->civil_status;
        $patient->father = $request->father;
        $patient->mother = $request->mother;
        $patient->spouse = $request->spouse;
        $patient->spouse_address = $request->spouse_address;
        $patient->contact_no = $request->contact_no;
        $patient->e_name = $request->e_name;
        $patient->e_contact = $request->e_contact;
        $patient->e_address = $request->e_address;
        $patient->user_id = \Auth::user()->id;
        $patient->save();

        $users = User::all();

        Notification::send($users, new NewPatient($patient));

        event(new NotificationEvent());

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return $patient->load(['patientRecords' => function($query) {
            $query->with([
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
                'currentDiagnose',
            ]);
        }]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return $patient;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:191',
            'middle_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'suffix' => 'required|max:191',
            'birthdate' => 'required|max:191',
            'religion' => 'required|max:191',
            'sex' => 'required|max:191',
            'address' => 'required|max:191',
            'civil_status' => 'required|max:191',
            'father' => 'required|max:191',
            'mother' => 'required|max:191',
            'spouse' => 'required|max:191',
            'spouse_address' => 'required|max:191',
            'contact_no' => 'required|max:191',
            'e_name' => 'required|max:191',
            'e_contact' => 'required|max:191',
            'e_address' => 'required|max:191',
        ]);
        
        $patient->first_name = $request->first_name;
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->suffix = $request->suffix;
        $patient->birthdate = $request->birthdate;
        $patient->religion = $request->religion;
        $patient->sex = $request->sex;
        $patient->address = $request->address;
        $patient->civil_status = $request->civil_status;
        $patient->father = $request->father;
        $patient->mother = $request->mother;
        $patient->spouse = $request->spouse;
        $patient->spouse_address = $request->spouse_address;
        $patient->contact_no = $request->contact_no;
        $patient->e_name = $request->e_name;
        $patient->e_contact = $request->e_contact;
        $patient->e_address = $request->e_address;
        $patient->user_id = \Auth::user()->id;
        $patient->save();

        return response()->json([
            'message' => 'success',
            'patient' => $patient
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }

    public function available() 
    {
        $patients = Patient::whereDoesntHave(
            'patientRecords', function($query) {
                $query->where('discharged', 0);
            }
        )->get();
        return $patients;
    }
    
}

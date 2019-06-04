<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Patient;
use App\TypeOfRecord;
use App\Disposition;
use App\Result;
use App\PhilhealthMembership;
use App\PatientDiagnose;
use App\NurseNote;
use App\MedicationAndTreatment;
use App\VitalSign;
use App\IntravenousFluid;
use App\DoctorsOrder;
use App\Room;
use App\TypeOfCharge;

class PatientRecord extends Model
{

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getFullNameAttribute()
    {
        return "{$this->patient->full_name}";
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function patient()
    {
    	return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function typeOfRecord()
    {
    	return $this->belongsTo(TypeOfRecord::class, 'type_of_record_id');
    }

    public function disposition()
    {
    	return $this->belongsTo(Disposition::class, 'disposition_id');
    }

    public function result()
    {
    	return $this->belongsTo(Result::class, 'result_id');
    }

    public function philhealthMembership()
    {
    	return $this->belongsTo(PhilhealthMembership::class, 'result_id');
    }

    public function admitAndCheckBy()
    {
    	return $this->belongsTo(User::class, 'admit_and_check_by');
    }
    
    public function dischargedBy()
    {
    	return $this->belongsTo(User::class, 'discharged_by');
    }
    
    public function physician()
    {
    	return $this->belongsTo(User::class, 'physician_id');
    }
    
    public function chartCompletedBy()
    {
    	return $this->belongsTo(User::class, 'chart_completed_by');
    }

    public function patientDiagnoses()
    {
        return $this->hasMany(PatientDiagnose::class);
    }

    public function nurseNotes()
    {
        return $this->hasMany(NurseNote::class);
    }

    public function medicationAndTreatments()
    {
        return $this->hasMany(MedicationAndTreatment::class);
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class);
    }

    public function intravenousFluids()
    {
        return $this->hasMany(IntravenousFluid::class);
    }

    public function doctorsOrders()
    {
        return $this->hasMany(DoctorsOrder::class);
    }

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'patient_rooms')->withTimestamps();
    }

    public function patientRooms()
    {
    	return $this->belongsToMany(PatientRoom::class, 'billings')->withTimestamps();
    }

    public function currentRoom()
    {
        // return $this->patientRooms()->latest();
        return $this->hasOne(PatientRoom::class)->latest();
    }

    public function typeOfCharges()
    {
        return $this->belongsToMany(TypeOfCharge::class, 'billings')->withTimestamps();
    }

}

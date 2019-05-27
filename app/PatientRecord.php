<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Patient;
use App\TypeOfRecord;
use App\Disposition;
use App\Result;
use App\PhilhealthMembership;

class PatientRecord extends Model
{

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];


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

    public function patientRooms()
    {
    	return $this->hasMany(PatientRoom::class);
    }

    public function currentRoom()
    {
        // return $this->patientRooms()->latest();
        return $this->hasOne(PatientRoom::class)->latest();
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getFullNameAttribute()
    {
        return "{$this->patient->full_name}";
    }

}

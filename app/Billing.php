<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypeOfCharge;
use App\PatientRecord;

class Billing extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    // protected $with = ['patientRecord', 'typeOfCharge'];
    
	public function patientRecord()
    {
    	return $this->belongsTo(PatientRecord::class, 'patient_record_id');
    }

    public function typeOfCharge()
    {
    	return $this->belongsTo(TypeOfCharge::class, 'type_of_charge_id');
    }
}

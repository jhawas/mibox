<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PatientRecord;

class MedicationAndTreatment extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['patientRecord'];
    
    public function patientRecord() 
    {
    	return $this->belongsTo(PatientRecord::class, 'patient_record_id');
    }
}

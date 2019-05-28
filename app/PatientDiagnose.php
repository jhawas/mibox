<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PatientRecord;
use App\Diagnose;

class PatientDiagnose extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['patientRecord', 'diagnose'];
    
    public function patientRecord() 
    {
    	return $this->belongsTo(PatientRecord::class, 'patient_record_id');
    }

    public function diagnose() 
    {
    	return $this->belongsTo(Diagnose::class, 'patient_record_id');
    }
}

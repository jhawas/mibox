<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Insurance;
use App\PatientRecord;

class PatientInsurance extends Model
{
    protected $with = ['insurance', 'patientRecord'];

    public function patientRecord()
    {
    	return $this->belongsTo(PatientRecord::class);
    }

    public function insurance()
    {
    	return $this->belongsTo(Insurance::class);
    }
}

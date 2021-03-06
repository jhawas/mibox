<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PatientRecord;
use App\TypeOfCharge;

class IntravenousFluid extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['patientRecord', 'typeOfCharge', 'billing'];
    
    public function patientRecord() 
    {
    	return $this->belongsTo(PatientRecord::class, 'patient_record_id');
    }

    public function typeOfCharge()
    {
        return $this->belongsTo(TypeOfCharge::class, 'type_of_charge_id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class, 'intravenous_fluid_id');
    }
}

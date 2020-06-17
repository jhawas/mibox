<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PatientRecord;
use App\Diagnose;
use App\User;

class PatientDiagnose extends Model
{

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['diagnose_name'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['patientRecord', 'diagnose'];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getDiagnoseNameAttribute()
    {
        return "{$this->diagnose->name}";
    }


    public function patientRecord()
    {
    	return $this->belongsTo(PatientRecord::class, 'patient_record_id');
    }

    public function diagnose()
    {
    	return $this->belongsTo(Diagnose::class, 'diagnose_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Laboratory;

class DoctorsOrder extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['patientRecord', 'laboratories'];

    
    public function patientRecord() 
    {
    	return $this->belongsTo(PatientRecord::class, 'patient_record_id');
    }

    /**
     * laboratories one to many
     */
    public function laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }

}

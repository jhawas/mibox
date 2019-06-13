<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Discount;

class PatientDiscount extends Model
{

	protected $with = ['discount', 'patientRecord'];

    public function patientRecord()
    {
    	return $this->belongsTo(PatientRecord::class);
    }

    public function discount()
    {
    	return $this->belongsTo(Discount::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PatientRecord;
use App\Room;

class PatientRoom extends Model
{
	/**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    // protected $with = ['patientRecord', 'room'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['room_with_type'];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getRoomWithTypeAttribute()
    {
        return "{$this->room->room_with_type}";
    }

    public function scopeCurrentRoom($query, $patient_record_id) 
    {
        return $query->where('patient_record_id', $patient_record_id);
    }

    public function patientRecord()
    {
    	return $this->belongsTo(PatientRecord::class);
    }

    public function room()
    {
    	return $this->belongsTo(Room::class);
    }

    

    
}

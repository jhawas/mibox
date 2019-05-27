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

    public function patientRecord()
    {
    	return $this->belongsTo(PatientRecord::class);
    }

    public function room()
    {
    	return $this->belongsTo(Room::class);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getRoomWithTypeAttribute()
    {
        return "{$this->room->room_with_type}";
    }

    // /**
    //  * Get the user's full name.
    //  *
    //  * @param  string  $value
    //  * @return string
    //  */
    // public function getRoomValueAttribute()
    // {
    //     return $this->room->id;
    // }
}

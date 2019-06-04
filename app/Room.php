<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Floor;
use App\TypeOfCharge;
use App\PatientRecord;

class Room extends Model
{

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'room_with_type', 
        'patient_in_room', 
        'room_status', 
        'room_rate',
        'type_of_room_id',
    ];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getRoomWithTypeAttribute()
    {
        return "{$this->name} ({$this->typeOfRoom->name})";
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getTypeOfRoomIdAttribute()
    {
        return $this->typeOfRoom->id;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getRoomRateAttribute()
    {
        return $this->typeOfRoom->price;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getPatientInRoomAttribute()
    {
        return $this->patientRecords()->where('discharged', 0)->count();
    }

     /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getRoomStatusAttribute()
    {
        return $this->patientRecords()->where('discharged', 0)->count() >= $this->capacity;
    }


    public function scopeRoomRate($query, $room_id) {
        return $query->where('id', $room_id)->first();
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function floor()
    {
    	return $this->belongsTo(Floor::class);
    }

    public function typeOfRoom()
    {
    	return $this->belongsTo(TypeOfCharge::class, 'type_of_charge_id');
    }

    public function patientRecords()
    {
        return $this->belongsToMany(PatientRecord::class, 'patient_rooms')->withTimestamps();
    }

}

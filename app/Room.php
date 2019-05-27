<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Floor;
use App\TypeOfCharge;

class Room extends Model
{

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['room_with_type'];

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

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getRoomWithTypeAttribute()
    {
        return "{$this->name} ({$this->typeOfRoom->name})";
    }
}

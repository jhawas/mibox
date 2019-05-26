<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Floor;
use App\TypeOfCharge;

class Room extends Model
{
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
}

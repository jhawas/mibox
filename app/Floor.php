<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Room;

class Floor extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function rooms()
    {
    	return $this->hasMany(Room::class, 'floor_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypeOfCharge;

class GroupOfCharge extends Model
{
    public function typeOfCharges()
    {
    	return $this->hasMany(TypeOfCharge::class);
    }

}

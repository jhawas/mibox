<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfCharge extends Model
{
    public function parent() {
    	return $this->belongsTo('App\TypeOfCharge', 'parent_id');
    }
}

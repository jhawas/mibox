<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfCharge extends Model
{

	/**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['charge_id', 'charge_name'];

	/**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getChargeIdAttribute()
    {
        return $this->id;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getChargeNameAttribute()
    {
        return $this->name;
    }

    public function parent() {
    	return $this->belongsTo('App\TypeOfCharge', 'parent_id');
    }

    public function type() {
        return $this->belongsTo('App\Type', 'type_id');
    }
}

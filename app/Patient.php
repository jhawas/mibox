<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\PatientRecord;

class Patient extends Model
{
	/**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name', 'full_name_plain'];

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getMiddleNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the user's full name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name} (Case No.: {$this->case_no})";
    }

    /**
     * Get the user's full name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFullNamePlainAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function patientRecords()
    {
        return $this->hasMany(PatientRecord::class);
    }

    public function currentPatientRecords()
    {
        // return $this->patientRooms()->latest();
        return $this->hasOne(PatientRecord::class)->latest();
    }

}

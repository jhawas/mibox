<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypeOfCharge;
use App\Billing;

class Laboratory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_record_id',
        'doctors_order_id',
        'type_of_charge_id',
        'description',
        'images',
        'is_done',
        'user_id'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['laboratory', 'patientRecord', 'billing'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['charge_id', 'charge_name'];

    
    public function patientRecord() 
    {
        return $this->belongsTo(PatientRecord::class, 'patient_record_id');
    }

    /**
     * laboratories one to many
     */
    public function laboratory()
    {
        return $this->belongsTo(TypeOfCharge::class, 'type_of_charge_id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class, 'laboratory_id');
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getChargeIdAttribute()
    {
        return $this->laboratory->id;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getChargeNameAttribute()
    {
        return $this->laboratory->name;
    }
}

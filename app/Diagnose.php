<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Diagnose extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['diagnose_name', 'diagnose_id'];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getDiagnoseNameAttribute()
    {
        return "{$this->name}";
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getDiagnoseIdAttribute()
    {
        return $this->id;
    }

	/**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function parent()
    {
    	return $this->belongsTo($this, 'parent_id');
    }
}

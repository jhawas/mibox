<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Diagnose extends Model
{
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    public function users() {
	    return $this->belongsToMany(User::class);
    }

	public function createdBy() {
		return $this->belongsTo(User::class, 'created_by');
	}

	public function modifiedBy() {
		return $this->belongsTo(User::class, 'modified_by');
	}
}

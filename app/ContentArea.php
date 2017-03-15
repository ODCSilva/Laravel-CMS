<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentArea extends Model
{
	protected $fillable = ['name', 'alias', 'description'];
    //
	public function articles() {
		return $this->hasMany(Article::class);
	}

	public function createdBy() {
		return $this->belongsTo(User::class, 'created_by');
	}

	public function modifiedBy() {
		return $this->belongsTo(User::class, 'modified_by');
	}
}

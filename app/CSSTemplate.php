<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CSSTemplate extends Model
{
	protected $fillable = ['name', 'description', 'css_content'];
	protected $table = 'templates';

	public function createdBy() {
		return $this->belongsTo(User::class, 'created_by');
	}

	public function modifiedBy() {
		return $this->belongsTo(User::class, 'modified_by');
	}
}

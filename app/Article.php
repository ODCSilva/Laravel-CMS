<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $fillable = ['name', 'title', 'description', 'html_content', 'page_id', 'content_area_id'];
    public function area() {
	    return $this->belongsTo(ContentArea::class, 'content_area_id');
    }

    public function page() {
	    return $this->belongsTo(Page::class);
    }

	public function createdBy() {
		return $this->belongsTo(User::class, 'created_by');
	}

	public function modifiedBy() {
		return $this->belongsTo(User::class, 'modified_by');
	}
}

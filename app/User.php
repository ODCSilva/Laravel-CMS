<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function hasPrivilege($privilegeName) {

		//foreach($privilegeName as $pName) {
			foreach($this->privileges as $p) {
				if ($p->name == $privilegeName) {
					return true;
				}
			}
		//}


		return false;
	}

	public function privileges() {
		return $this->belongsToMany(Privilege::class);
	}

	public function createdPages() {
		return $this->hasMany(Page::class);
	}

	public function modifiedPages() {
		return $this->hasMany(Page::class);
	}

	public function createdArticles() {
		return $this->hasMany(Article::class);
	}

	public function modifiedArticles() {
		return $this->hasMany(Article::class);
	}

	public function createdContentAreas() {
		return $this->hasMany(ContentArea::class);
	}

	public function modifiedContentAreas() {
		return $this->hasMany(ContentArea::class);
	}

	public function createdTemplates() {
		return $this->hasMany(CSSTemplate::class);
	}

	public function modifiedTemplates() {
		return $this->hasMany(CSSTemplate::class);
	}

	public function createdBy() {
		return $this->belongsTo(User::class, 'created_by');
	}

	public function modifiedBy() {
		return $this->belongsTo(User::class, 'modified_by');
	}
}

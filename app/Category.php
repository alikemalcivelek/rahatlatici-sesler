<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	public static $snakeAttributes = false;
	public $timestamps = false;

	protected $table = 'categories';

	public function getBackgroundImageAttribute($value) {
		if ( empty($value) )
		return null;

		// Convert image path to url.
		return asset($value);
	}
}

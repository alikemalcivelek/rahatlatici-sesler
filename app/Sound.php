<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sound extends Model {
	public static $snakeAttributes = false;
	public $timestamps = false;

	protected $table = 'sounds';

	public function favorite() {
		return $this->hasMany('App\Favorite', 'soundId', 'id');
	}

	public function getSoundFileAttribute($value) {
		// Convert sound file path to url.
		return asset($value);
	}
}

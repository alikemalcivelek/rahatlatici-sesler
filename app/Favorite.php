<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {
	public static $snakeAttributes = false;
	public $timestamps = false;

	protected $table = 'favorites';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'userId',
		'soundId'
	];

	public function sound() {
		return $this->belongsTo('App\Sound', 'soundId', 'id');
	}
}

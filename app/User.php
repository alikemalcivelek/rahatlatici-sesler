<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	public static $snakeAttributes = false;
	public $timestamps = false;

	protected $table = 'users';

	protected $dates = [
		'created'
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'fullName',
		'email',
		'password',
		'apiToken'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'rememberToken',
		'apiToken'
	];

	public function getRememberTokenName() {
		return 'rememberToken';
	}
}

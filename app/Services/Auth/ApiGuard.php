<?php

namespace App\Services\Auth;

use Illuminate\Auth\TokenGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class ApiGuard extends TokenGuard {
	public function __construct(UserProvider $provider, Request $request) {
		parent::__construct($provider, $request);

		$this->inputKey = 'apiToken';
		$this->storageKey = 'apiToken';
	}
}

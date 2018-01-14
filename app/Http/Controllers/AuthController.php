<?php

namespace App\Http\Controllers;

use App\User;
use App\Libraries\Responder;

use Illuminate\Support\Str;

use Auth;
use Session;
use Request;
use Validator;
use Lang;
use Hash;

class AuthController extends Controller {
	public function status() {
		return Responder::success([
			'signedIn' => Auth::check()
		]);
	}

	public function signUp() {
		$input = Request::only([
			'fullName',
			'email',
			'password',
			'passwordConfirmation'
		]);

		$rules = [
			'fullName' => [
				'string',
				'between:1,45',
				'regex:/^[\p{L}\ ]+$/u'
			],

			'email' => [
				'required',
				'string',
				'email',
				'between:6,191',
				'unique:users'
			],

			'password' => [
				'required',
				'string',
				'min:6',
				'same:passwordConfirmation'
			],

			'passwordConfirmation' => [
				'required',
				'string',
				'min:6',
				'same:password'
			]
		];

		$validator = Validator::make($input, $rules);

		if ( $validator->fails() )
		return Responder::error($validator->errors());

		$input['password'] = Hash::make($input['password']);
		$input['apiToken'] = Str::random(60);

		$user = new User;

		$user->fill($input);

		if ( !$user->save() )
		return Responder::error(
			Lang::get('auth.signUpFailed')
		);

		Auth::guard('web')->login($user);

		if ( !Auth::guard('web')->check() )
		return Responder::error(
			Lang::get('auth.signUpFailed')
		);

		return Responder::success([
			'token' => $user->apiToken,
			'user' => $user
		]);
	}

	public function signIn() {
		$attempt = [
			'email' => Request::input('email'),
			'password' => Request::input('password')
		];

		if ( !Auth::guard('web')->attempt($attempt) )
		return Responder::error(
			Lang::get('auth.invalidCredentials')
		);

		$user = Auth::guard('web')->user();

		$user->apiToken = Str::random(60);

		if ( !$user->save() )
		return Responder::error(
			Lang::get('auth.signInFailed')
		);

		return Responder::success([
			'token' => $user->apiToken,
			'user' => $user
		]);
	}

	public function signOut() {
		$user = Auth::user();

		$user->apiToken = null;

		if ( !$user->save() )
		return Responder::error(
			Lang::get('auth.signOutFailed')
		);

		Auth::guard('web')->logout();
		Session::flush();

		return Responder::success();
	}
}

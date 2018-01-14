<?php

namespace App\Http\Controllers;

use App\Sound;
use App\Favorite;
use App\Libraries\Responder;

use Auth;
use Lang;

class FavoriteController extends Controller {
	public function favorites() {
		// Get favorite sound list for current user.
		$favoriteSounds = Sound::whereHas('favorite', function($query) {
			$user = Auth::user();

			$query->where('userId', '=', $user->id);
		});

		return Responder::success([
			'favoriteSounds' => $favoriteSounds->get()
		]);
	}

	public function add($soundId) {
		$user = Auth::user();

		// Add sound to favorite for current user.
		$favorite = Favorite::updateOrCreate([
			'userId' => $user->id,
			'soundId' => $soundId
		]);

		if ( !$favorite )
		return Responder::error(
			Lang::get('favorite.errorWhileAdding')
		);

		return Responder::success();
	}

	public function remove($soundId) {
		$user = Auth::user();

		// Remove sound from favorite for current user.
		$favorite = Favorite::where('userId', '=', $user->id)
			->where('soundId', '=', $soundId)
			->delete();

		if ( !$favorite )
		return Responder::error(
			Lang::get('favorite.errorWhileRemoving')
		);

		return Responder::success();
	}
}

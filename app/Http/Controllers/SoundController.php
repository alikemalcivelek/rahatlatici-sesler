<?php

namespace App\Http\Controllers;

use App\Sound;
use App\Libraries\Responder;

class SoundController extends Controller {
	public function sounds($categoryId) {
		// Get sound list in given category id.
		$sounds = Sound::where('categoryId', '=', $categoryId)->get();

		return Responder::success([
			'sounds' => $sounds
		]);
	}
}

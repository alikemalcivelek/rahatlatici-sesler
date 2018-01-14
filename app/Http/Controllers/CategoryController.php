<?php

namespace App\Http\Controllers;

use App\Category;
use App\Libraries\Responder;

use Cache;

class CategoryController extends Controller {
	public function categories() {
		// Cache results for 60 minutes.
		$categories = Cache::remember('categories', 60, function() {
			return Category::all();
		});

		return Responder::success([
			'categories' => $categories
		]);
	}
}

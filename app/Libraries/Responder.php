<?php

namespace App\Libraries;

use Response;

class Responder {
	public static $template = [
		'success' => null,
		'errorCode' => null,
		'errorMessage' => null,
		'result' => null
	];

	public static function success($result = null) {
		$response = self::$template;

		$response['success'] = true;
		$response['result'] = $result;

		return Response::json($response);
	}

	public static function error($message = null, $code = null) {
		$response = self::$template;

		$response['success'] = false;
		$response['errorCode'] = $code;
		$response['errorMessage'] = $message;

		return Response::json($response);
	}
}

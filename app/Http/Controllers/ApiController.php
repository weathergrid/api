<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller {

	function respondOk($data) {
		$status = [
			'info' => ['success' => true]
		];
		$arr = array_merge($data, $status)
		return response()->json($arr);
	}

	function respondError($message, $status) {

	}

}
<?php

namespace App\Http\Controllers\v1;
use App\Http\Controllers\Controller;

class StatusController extends Controller {
    function ping()
    {
    	return ['pong' => true, 'success' => true];
    }

    function system_status()
    {

    }
}
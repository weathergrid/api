<?php

namespace App\Http\Controllers\v1;

use App\User;
use App\Http\Controllers\Controller;

class NodesController extends Controller
{
    function all() {
        var_dump(Request::input('offset', 'limit'));
    }
}
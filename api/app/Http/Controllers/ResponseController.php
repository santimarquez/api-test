<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    static function send($msg, $http_error_code) {
        return response()->json([
            "msg" => $msg
        ], $http_error_code);
    }
}

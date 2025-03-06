<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $validation;
    // public static $path;
    public function response($data, $status) {
        return response()->json([
            "message" => $data
        ], $status);
    }
}

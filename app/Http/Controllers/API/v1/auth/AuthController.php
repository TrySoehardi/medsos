<?php

namespace App\Http\Controllers\API\v1\auth;

use Illuminate\Http\Request;
use App\Services\Internal\AuthService;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\v1\BaseController;

class AuthController extends BaseController
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function login(Request $request) {
        $validation = [
            "email" => "required",
            "password" => "required"
        ];

        //~~~~~~ validation require data check ~~~~~~~~ //
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return $this->response($validator->errors(), 422);
        }
        $token = $this->authService->login($validator->valid());
        return $this->response($token, 200);
    }
}

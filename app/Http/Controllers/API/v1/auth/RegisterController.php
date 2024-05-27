<?php

namespace App\Http\Controllers\API\v1\auth;

use Illuminate\Http\Request;
use App\Services\Internal\AuthService;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\v1\BaseController;

class RegisterController extends BaseController
{
    public static $patch = "register";

    public function __construct(
        protected AuthService $authService
    ) {
        $this->validation = [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email:rfc,dns'
        ];
    }

    public function index(Request $request) {
        // ~~~~~~~~ validate data request ~~~~~~~~~~~~~~~
        $validator = Validator::make($request->all(), $this->validation);
        if ($validator->fails()) {
            // return response($content = $validator->fails(). 422);
            return $this->response($validator->errors(), 422);
        }

        //~~~~~~~~~ if success of validated ~~~~~~~~~~
        // save the user data
        $userData = $validator->valid();
        $resultSave = $this->authService->register($userData);
        return $this->response($resultSave, 200);

    }
}

<?php

namespace App\Http\Controllers\API\v1\put;

use Illuminate\Http\Request;
use App\Services\Internal\UserService;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\v1\BaseController;

class PutUserController extends BaseController
{
    public static $path = "user";
    public function __construct(
        protected UserService $userService
    ) {
        $this->validation = [
            'name' => 'nullable',
            'bio' => 'nullable',
            'profilePicture' => 'nullable',
        ];
    }

    public function index(Request $request) {
        $validator = Validator::make($request->all(), $this->validation);
        if ($validator->fails() || count($validator->valid()) < 1) {
            return $this->response("All field can't be empty", 422);
        }
        $result = $this->userService->updateUser($request->bearerToken(), $validator->valid());
        return $this->response($validator->valid(), 200);

    }
}

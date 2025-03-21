<?php

namespace App\Http\Controllers\API\v1\get;

use Illuminate\Http\Request;
use App\Services\Internal\UserService;
use App\Http\Controllers\API\v1\BaseController;

class GetUserController extends BaseController
{
    public static $path = "user";
    public function __construct(
        protected UserService $userService
    ) {}
    
    public function index(Request $request) {
        if($request->query('user')) {
            $name = $request->query('user');
            $result = $this->userService->getUserByName($name);
            return $this->response($result, 200);
        } else {
            $result = $this->userService->getUser($request->bearerToken());
            return $this->response($result, 200);
        }
    }
}

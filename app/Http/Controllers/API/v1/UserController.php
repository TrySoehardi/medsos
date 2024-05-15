<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Internal\UserService;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\throwException;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(Request $request) {
        // var_dump($request->bearerToken());
        $result = $this->userService->getUser($request->bearerToken());
        return response(($content=$result));
    }

    public function update(Request $request) {
        $rules = [
            'name' => 'nullable',
            'bio' => 'nullable',
            'profilePicture' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails() || count($validator->valid()) < 1) {
            return response()->json(['errors'=>$validator->errors()], $status = 422);
        }

        $result = $this->userService->updateUser($request->bearerToken(), $validator->valid());
        return response($content= $result);
    }
}

<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\Internal\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ){}
    // public function index() {
    //     $result = $this->authService->getUser();
    //     return response(($content=$result));
    // }
    
    public function index(Request $request) {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()], $status = 442);
        } 
        $token = $this->authService->login($validator->valid());
        return response()->json([
            'message' => 'success',
            'token' => $token,
            'tokenType' => 'Bearer'
        ]);
    }

    public function register(Request $request) {
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email:rfc,dns'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], $status = 422);
        }
        $result = $this->authService->register($validator->valid());
        return response($content=$result);
    }
}
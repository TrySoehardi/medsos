<?php

namespace App\Http\Controllers\API\v1\get;

use App\Http\Controllers\API\v1\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Internal\FollowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetFollow extends BaseController
{
    public static $path = "follow";
    public function __construct(
        protected FollowService $followService
    )
    {
        $this->validation = [
            'type' => 'required'
        ];
    }

    public function index(Request $request) {
        define("FOLLOWING", 'following');
        define("FOLLOWER", 'follower');
        $validation = Validator::make($request->query(), $this->validation);
        if($validation->fails()) {
            return $this->response($validation->errors(), 422);
        }
        
        if($request->query('type')== FOLLOWER) {
            $result = $this->followService->getFollower($request->bearerToken(), $request->query('type'));
            return $this->response($result, 200);
        }

        if($request->query('type') == FOLLOWING) {
            $result = $this->followService->getFollower($request->bearerToken(), $request->query('type'));
            return $this->response($result, 200);
        }
    }
}

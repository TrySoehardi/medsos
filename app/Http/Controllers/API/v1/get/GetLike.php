<?php

namespace App\Http\Controllers\API\v1\get;

use App\Http\Controllers\API\v1\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Internal\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetLike extends BaseController
{
    public static $path = 'like';
    public function __construct(
        protected LikeService $likeService
    )
    {
        $this->validation = [
            'postId' => 'required'
        ];
    }

    public function index(Request $request) {
        $validator = Validator::make($request->query(), $this->validation);
        if ($validator->fails()) {
            return $this->response($validator->errors(), 422);
        }

        $result = $this->likeService->getLike($validator->valid());
        return $this->response($result, 200);
    }
}

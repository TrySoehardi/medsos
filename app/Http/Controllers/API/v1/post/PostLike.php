<?php

namespace App\Http\Controllers\API\v1\post;

use App\Http\Controllers\API\v1\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Internal\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostLike extends BaseController
{
    public static $path = 'like';
    public function __construct(
        protected LikeService $likeService
    )
    {
        $this->validation = [
            'postId' => 'required|string'
        ];
    }

    public function index(Request $request) {
        $validator = Validator::make($request->all(), $this->validation);
        if ($validator->fails()) {
            return $this->response($validator->errors(), 422);
        }

        $data['post_id'] = $validator->valid()['postId'];

        $result = $this->likeService->save($request->bearerToken(), $data);
        return $this->response($result, 200);
    }

}

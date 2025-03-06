<?php

namespace App\Http\Controllers\API\v1\post;

use App\Http\Controllers\API\v1\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Internal\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostComment extends BaseController
{
    public static $path = 'comment';
    public function __construct(
        protected CommentService $commentService
    )
    {
        $this->validation = [
            'postId' => 'required',
            'comment' => 'required|string'
        ];
    }

    public function index(Request $request) {
        $validator = Validator::make($request->all(), $this->validation);
        if ($validator->fails()) {
            return $this->response($validator->errors(), 422);
        }
        $data = [
            'post_id' => $validator->valid()['postId'],
            'comment' => $validator->valid()['comment']
        ];
        $result = $this->commentService->save($data, $request->bearerToken());
        return $this->response($result, 200);
    }
}

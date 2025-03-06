<?php

namespace App\Http\Controllers\API\v1\put;

use App\Http\Controllers\API\v1\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Internal\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PutPost extends BaseController
{
    public static $path = 'post';

    public function __construct(
        protected PostService $postService
    )
    {
        $this->validation = [
            'content' => 'required|string|max:255'
        ];
    }

    public function index(Request $request) {
        $validator = Validator::make($request->all(), $this->validation);
        if ($validator->fails()) {
            return $this->response($validator->errors(), 422);
        }

        $result = $this->postService->update($validator->valid(), $request->bearerToken());
        return $this->response($result, 200);
    }
}

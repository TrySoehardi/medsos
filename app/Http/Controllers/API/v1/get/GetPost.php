<?php

namespace App\Http\Controllers\API\v1\get;

use App\Http\Controllers\API\v1\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Internal\PostService;
use Illuminate\Http\Request;

class GetPost extends BaseController
{
    public static $path = 'post';
    public function __construct(
        protected PostService $postService
    )
    {

    }

    public function index(Request $request) {
        if($request->query('userId')) {
            $result = $this->postService->getByUserId($request->query('userId'));
            return $this->response($result, 200);
            
        }

        if($request->query('postId')) {
            $result = $this->postService->getById($request->query('postId'));
            return $this->response($result, 200);

        }

        // get all post from user
        $result = $this->postService->getAll();
        return $this->response($result, 200);

    }
}

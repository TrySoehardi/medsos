<?php

namespace App\Http\Controllers\API\v1\post;

use App\Http\Controllers\API\v1\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Internal\FollowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostFollow extends BaseController
{
    public static $path = "follow";
    
    public function __construct(
        protected FollowService $followService
    )
    {
        $this->validation = [
            'email' => 'required',
            // 'id_given_like' => 'required'
        ];
    }

    public function index(Request $request) {
        // note : The user who accesses this is the user who likes the status
        
        $validator = Validator::make($request->all(), $this->validation);
        if ($validator->fails()) {
            return $this->response($validator->errors(), 422);
        }

        $data = $validator->valid();
        $result = $this->followService->save($data, $request->bearerToken());
        return $this->response($result, 200);

    }

}

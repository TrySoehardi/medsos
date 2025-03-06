<?php

namespace App\Http\Controllers\API\v1\post;

use App\Http\Controllers\API\v1\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Internal\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostPost extends BaseController
{
    public static $path = "post";
    public function __construct(
        protected PostService $postService
    )
    {
        $this->validation = [
            'content' => 'required|string|max:255',
            'mediaType' => 'required|string',
            'file' => 'required|file|mimes:jpg,jpeg,png'
        ];
    }

    public function index(Request $request) {
        $validator = Validator::make($request->all(), $this->validation);
        if ($validator->fails()) {
            return $this->response($validator->errors(), 422);
        }
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            // Store the file in the 'public' disk, within a 'uploads' folder
            $file = $request->file('file');

            $fileName = Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            // save data in database
            $data = [
                'content' => $validator->valid()['content'],
                'media_type' => $validator->valid()['mediaType'],
                'media_url' => Storage::url($filePath)
            ];
            $result = $this->postService->save($data, $request->bearerToken());
            return $this->response($result, 200);
        }
    }
    
}

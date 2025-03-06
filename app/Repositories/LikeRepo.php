<?php

namespace App\Repositories;

use App\Models\Like;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Ramsey\Uuid\Uuid;

class LikeRepo 
{
     public function __construct(
          protected Like $like
     ){}

     public function save($data) {
          $result = $this->like->create($data);
          return $result;
     }

     public function delete($data) {
          $result = $data->delete();
          return $result;
       }

     public function checkData($data) {
          $result = $this->like->query()->where($data)->first();
          return $result;
     }

     public function findLikeCount($postId) {
          $result = $this->like->query()->where('post_id', $postId)->get()->count();
          return $result;
     }
}

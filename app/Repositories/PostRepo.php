<?php

namespace App\Repositories;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Ramsey\Uuid\Uuid;

class PostRepo 
{
     public function __construct(
          protected Post $post
     ){}

     public function save($data) {
          $result = $this->post->create($data);
          return $result;
     }

     public function updateByUserId($userId, $data) {
          $result = $this->post->query()->where('user_id', $userId)->update($data);
          return $result;
     }

     public function findAll() {
          $result = $this->post->get();
          return $result;
     }

     public function findByUserId($userId) {
          $result = $this->post->query()->where('user_id', $userId)->get();
          return $result;
     }

     public function findByid($id) {
          // $result = $this->post->query()->where('id', $id)->first();
          $result = $this->post->with('comment')->where('id', $id)->first();
          return $result;
     }
}

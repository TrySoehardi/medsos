<?php

namespace App\Repositories;

use App\Models\Comment;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Ramsey\Uuid\Uuid;

class CommentRepo 
{
     public function __construct(
          protected Comment $comment
     ){}

     public function save($data) {
          $result = $this->comment->create($data);
          return $result;
     }

     public function update($id, $data) {
          $result = $this->comment->query()->where('id', $id)->update($data);
          return $result;
     }

     public function findById($id) {
          $result = $this->comment->query()->where('id', $id)->first();
          return $result;
     }
}

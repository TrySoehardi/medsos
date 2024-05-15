<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Ramsey\Uuid\Uuid;

class UserRepo 
{
     public function __construct(
          protected User $user
     ){}

     public function save($data) {
          $result = $this->user->create($data);
          $result->createToken($data['email']);
          return $result;
     }

     public function createToken($email) {
          $result = $this->user->query()->where('email',$email)->first();
          return $token = $result->createToken($email);
     }

     public function findByEmail($email) {
          return $this->user->query()->where('email',$email)->first();
     }

     public function findUser($email) {
          return $result = $this->user->with('follow')->where('email',$email)->first();
     } 

     public function update($id, $data) {
          return $this->user->query()->where('id', $id)->update($data);
     }
}

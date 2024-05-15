<?php

namespace App\Services\Internal;

use App\Repositories\UserRepo;
use Laravel\Sanctum\PersonalAccessToken;
class UserService 
{
   public function __construct(
      protected UserRepo $userRepo
   )
   {}

   public function getUser($token) {
      $email = PersonalAccessToken::findToken($token)->first();
      $result = $this->userRepo->findUser($email['name']);
      return $result;
   }

   public function updateUser($token, $data) {
      $id = $this->getUser($token);
      return $this->userRepo->update($id['id'], $data);
   }

}

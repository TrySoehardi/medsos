<?php

namespace App\Services\Internal;

use Error;
use App\Exceptions\Errors;
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
      try {
         return $result = $this->userRepo->update($id['id'], $data);
      } catch (Error $erro) {
         throw new Errors($erro, 409);
      }
   }

}

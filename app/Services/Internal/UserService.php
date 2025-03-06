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

   public function getUserByName($name) {
      $result = $this->userRepo->findByName($name);
      return $result;
   }

   public function getUserByEmail($email) {
      $result = $this->userRepo->findByEmail($email);
      return $result;
   }

   public function getUser($token) {
      $email = PersonalAccessToken::findToken($token)->first();
      $result = $this->userRepo->findUser($email['name']);
      return $result;
   }

   public function getUserById($userId) {
      $result = $this->userRepo->findById($userId);
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

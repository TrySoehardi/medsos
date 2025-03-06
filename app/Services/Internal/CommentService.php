<?php

namespace App\Services\Internal;

use App\Repositories\CommentRepo;
use App\Repositories\UserRepo;

class CommentService 
{
   public function __construct(
        protected CommentRepo $commentRepo,
        protected UserService $userService
   )
   {}

   public function save($data, $token) {
        $user = $this->userService->getUser($token);
        $data['user_id'] = $user['id'];
        $result = $this->commentRepo->save($data);
        return $result;
   }

   public function update($data) {
        $result = $this->commentRepo->update($data['commentId'],$data);
        return $result;
   }

   public function delete($id) {

   }

}

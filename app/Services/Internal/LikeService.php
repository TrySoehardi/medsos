<?php

namespace App\Services\Internal;

use App\Exceptions\NotFoundError;
use App\Repositories\LikeRepo;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LikeService 
{
   public function __construct(
        protected LikeRepo $likeRepo,
        protected UserService $userService,
        protected PostService $postService
   )
   {}

   public function save($token, $data) {
        $user = $this->userService->getUser($token);
        $data['user_id'] = $user['id'];

        $checkPostData = $this->postService->getById($data['post_id']);
        if(!$checkPostData) {
            throw new NotFoundError("Post Not Found", 404);
        }
        
        $checkData = $this->likeRepo->checkData($data);
        if(!$checkData) {
            // like
            $result = $this->likeRepo->save($data);
            return 'Like';
        } else {
            // unlike
            $result = $this->likeRepo->delete($checkData);
            return 'unlike';
        }
   }

   public function getLike($postId) {
       $result = $this->likeRepo->findLikeCount($postId);
       return $result;
   }

}

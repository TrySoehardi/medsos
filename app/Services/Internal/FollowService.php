<?php

namespace App\Services\Internal;

use Error;
use App\Exceptions\Errors;
use App\Exceptions\NotFoundError;
use App\Models\Follow;
use App\Repositories\FollowRepo;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Laravel\Sanctum\PersonalAccessToken;

class FollowService 
{
   public function __construct(
        protected FollowRepo $followRepo,
        protected UserService $userService
   )
   {}

   public function save($data, $token) {
        $followingData = $this->userService->getUser($token);
        $data['id_given_like'] = $followingData['id'];

        $followedData = $this->userService->getUserByEmail($data['email']);
        if(!$followedData) {
            throw new NotFoundError('Not Found Error', 404);
        }
        $data = [
            'user_id'=> $followedData['id'],
            'id_given_like' => $followingData['id']
        ];

        // check if user was following
        $checkStatusFollow = $this->followRepo->checkData($data);
        if($checkStatusFollow) {
            //unfollow
            $resultDelete = $this->followRepo->delete($checkStatusFollow);
            return "Unfollow";
        } else {
            // follow
            $resultSave = $this->followRepo->save($data);
            return "Follow";
        }
        
   }

   public function getFollower($token, $type) {
        $user = $this->userService->getUser($token);
        if ($type == 'follower') {
            $result = $this->followRepo->findByUserId($user['id']);
            return $result;
        } else if($type == 'following') {
            $result = $this->followRepo->findByGivenId($user['id']);
            return $result;
        }
   }

}

<?php

namespace App\Services\Internal;

use App\Exceptions\EmailExist;
use App\Exceptions\LoginFailed;
use App\Exceptions\NotFoundError;
use App\Repositories\PostRepo;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PostService 
{
    public function __construct(
        protected PostRepo $postRepo,
        protected UserService $userService
    ){}

    public function save($data, $token) {
        $user = $this->userService->getUser($token);
        $data['user_id'] = $user['id'];

        $result = $this->postRepo->save($data);
        return $result;
    }

    public function update($data, $token) {
        $user = $this->userService->getUser($token);

        $result = $this->postRepo->updateByUserId($user['id'], $data);
        return $result;

    }

    public function getById($id) {
        $result = $this->postRepo->findByid($id);
        return $result;
    }

    public function getByUserId($userId) {
        $result = $this->postRepo->findByUserId($userId);
        return $result;
    }

    public function getAll() {
        $result = $this->postRepo->findAll();
        return $result;
    }
}
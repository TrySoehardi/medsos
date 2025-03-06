<?php

namespace App\Services\Internal;

use App\Exceptions\EmailExist;
use App\Exceptions\LoginFailed;
use App\Exceptions\NotFoundError;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService 
{
    public function __construct(
        protected UserRepo $userRepo
    ){}

    public function login($data) {
        if (! Auth::attempt($data)) {
            throw new NotFoundError('user not found',404);
        }
        return $this->userRepo->createToken($data['email']);
    }

    public function register($data) {
        $data['password'] = Hash::make($data['password']);
        $check = $this->userRepo->findByEmail($data['email']);
        if(!$check) {
            return $result = $this->userRepo->save($data);
        }
        throw new EmailExist('Email Already Exist', 403);
    }
}
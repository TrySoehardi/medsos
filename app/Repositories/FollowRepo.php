<?php

namespace App\Repositories;

use App\Models\Follow;
use Exception;
use GuzzleHttp\Psr7\Query;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Ramsey\Uuid\Uuid;

class FollowRepo 
{
     public function __construct(
        protected Follow $follow
     ){}

     public function save($data) {
        $resultSave = $this->follow->create($data);
        return $resultSave;
     }

     public function delete($data) {
        $result = $data->delete();
        return $result;
     }

     public function checkData($data) {
        $result = $this->follow->query()->where($data)->first();
        return $result;
     }

     public function findByUserId($userId) {
      //   $result = $this->follow->query()->where('user_id', $userId)->get();
        $result = $this->follow->join('users', 'follows.user_id', '=', 'users.id')->where('user_id', $userId)->get();
        return $result;

     }

     public function findByGivenId($givenId) {
      //   $result = $this->follow->query()->where('id_given_like', $givenId)->get();
        $result = $this->follow->join('users', 'follows.id_given_like', '=', 'users.id')->where('id_given_like', $givenId)->get();
        return $result;
     }
}

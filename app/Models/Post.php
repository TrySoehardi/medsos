<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory, HasUuids;

    public function like(): HasOne {
        return $this->hasMany(Like::class)->latestOfMany();
    }

    public function comment(): HasOne {
        return $this->hasMany(Comment::class)->latestOfMany();
    }

}

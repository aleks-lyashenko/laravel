<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;

//    public function post() {
//        return $this->hasOne('App\Post');
//        return $this->hasOne(Post::class);
//    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}

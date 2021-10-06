<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

//    protected $attributes = [
//        'content' => 'Aqdsdlihjzxif',
//    ];

//белый список для массового присвоения
    protected $fillable = ['title', 'content', 'rubric_id'];

    public function rubric() {
        return $this->belongsTo(Rubric::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function getPostDate() {
    return Carbon::parse($this->created_at)->diffForHumans();
}
}

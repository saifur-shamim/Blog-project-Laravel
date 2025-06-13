<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'category', 'author_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}


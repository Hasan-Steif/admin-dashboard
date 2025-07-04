<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Post.php
class Post extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'image', 'description', 'body', 'views', 'is_published'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

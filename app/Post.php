<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['message', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

  /**
     * Get all of the post's likes.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
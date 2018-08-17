<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'is_reply_to',
        'review_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'is_reply_to');
    }
}

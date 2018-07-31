<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'content', 'title', 'movie_id'];
}

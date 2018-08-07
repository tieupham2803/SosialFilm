<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    //
    protected $fillable = ['movie_id', 'genre_id'];

    protected $table = 'genre_movie';
}
